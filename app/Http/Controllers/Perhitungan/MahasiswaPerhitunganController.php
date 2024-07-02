<?php

namespace App\Http\Controllers\Perhitungan;

use App\DataTables\Perhitungan\MahasiswaPerhitunganDataTables;
use App\DataTables\Perhitungan\PeriodeMahasiswaPerhitunganDataTables;
use App\Http\Controllers\Controller;
use App\Models\KelompokUkt;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Phpml\Classification\NaiveBayes;
use Phpml\Metric\Accuracy;
use Phpml\ModelManager;

class MahasiswaPerhitunganController extends Controller
{
    public function index(PeriodeMahasiswaPerhitunganDataTables $dataTable)
    {
        return $dataTable->render('Perhitungan.index');
    }

    public function showMahasiswaPerhitungan($periode_id)
    {
        $this->updateUKTGroup($periode_id);
        $dataTable = new MahasiswaPerhitunganDataTables($periode_id);
        return $dataTable->render('Perhitungan.table-perhitungan');
    }

    public function updateUKTGroup($periode_id)
    {
        $mahasiswaList = Mahasiswa::with(['kelompokUkt', 'programStudi'])->where('id_periode', $periode_id)
            ->where('status_verifikasi', 'Diverifikasi')
            ->get();

        $mahasiswaByUkt = $mahasiswaList->groupBy(function ($item) {
            return $item->kelompokUkt->nama_kelompok_ukt;
        });

        $stats = [];

        foreach ($mahasiswaByUkt as $kelompokUkt => $mahasiswa) {
            $data = $mahasiswa->toArray();

            $meanJmlTanggungan = $this->mean($data, 'jml_tanggungan');
            $meanAnakDiTanggung = $this->mean($data, 'anak_di_tanggung');
            $meanPenghasilanAyah = $this->mean($data, 'penghasilan_ayah');
            $meanPenghasilanIbu = $this->mean($data, 'penghasilan_ibu');
            $meanPenghasilanGabungan = $this->mean($data, 'penghasilan_gabungan');
            $meanBesaranPdam = $this->mean($data, 'besaran_pdam');
            $meanBesaranPln = $this->mean($data, 'besaran_pln');
            $meanPajakMotor = $this->mean($data, 'pajak_motor');

            $stdDevJmlTanggungan = $this->standardDeviation($data, 'jml_tanggungan', $meanJmlTanggungan);
            $stdDevAnakDiTanggung = $this->standardDeviation($data, 'anak_di_tanggung', $meanAnakDiTanggung);
            $stdDevPenghasilanAyah = $this->standardDeviation($data, 'penghasilan_ayah', $meanPenghasilanAyah);
            $stdDevPenghasilanIbu = $this->standardDeviation($data, 'penghasilan_ibu', $meanPenghasilanIbu);
            $stdDevPenghasilanGabungan = $this->standardDeviation($data, 'penghasilan_gabungan', $meanPenghasilanGabungan);
            $stdDevBesaranPdam = $this->standardDeviation($data, 'besaran_pdam', $meanBesaranPdam);
            $stdDevBesaranPln = $this->standardDeviation($data, 'besaran_pln', $meanBesaranPln);
            $stdDevPajakMotor = $this->standardDeviation($data, 'pajak_motor', $meanPajakMotor);

            $stats[$kelompokUkt] = [
                'mean' => [
                    'jml_tanggungan' => $meanJmlTanggungan,
                    'anak_di_tanggung' => $meanAnakDiTanggung,
                    'penghasilan_ayah' => $meanPenghasilanAyah,
                    'penghasilan_ibu' => $meanPenghasilanIbu,
                    'penghasilan_gabungan' => $meanPenghasilanGabungan,
                    'besaran_pdam' => $meanBesaranPdam,
                    'besaran_pln' => $meanBesaranPln,
                    'pajak_motor' => $meanPajakMotor,
                ],
                'std_dev' => [
                    'jml_tanggungan' => $stdDevJmlTanggungan,
                    'anak_di_tanggung' => $stdDevAnakDiTanggung,
                    'penghasilan_ayah' => $stdDevPenghasilanAyah,
                    'penghasilan_ibu' => $stdDevPenghasilanIbu,
                    'penghasilan_gabungan' => $stdDevPenghasilanGabungan,
                    'besaran_pdam' => $stdDevBesaranPdam,
                    'besaran_pln' => $stdDevBesaranPln,
                    'pajak_motor' => $stdDevPajakMotor,
                ],
            ];
        }

        $finalResults = [];
        foreach ($mahasiswaList as $mhs) {
            $maxProb = -1;
            $maxKelompok = null;

            foreach ($stats as $kelompokUkt => $stat) {
                $probJmlTanggungan = $this->naiveBayesProb($mhs->jml_tanggungan, $stat['mean']['jml_tanggungan'], $stat['std_dev']['jml_tanggungan']);
                $probAnakDiTanggung = $this->naiveBayesProb($mhs->anak_di_tanggung, $stat['mean']['anak_di_tanggung'], $stat['std_dev']['anak_di_tanggung']);
                $probPenghasilanAyah = $this->naiveBayesProb($mhs->penghasilan_ayah, $stat['mean']['penghasilan_ayah'], $stat['std_dev']['penghasilan_ayah']);
                $probPenghasilanIbu = $this->naiveBayesProb($mhs->penghasilan_ibu, $stat['mean']['penghasilan_ibu'], $stat['std_dev']['penghasilan_ibu']);
                $probPenghasilanGabungan = $this->naiveBayesProb($mhs->penghasilan_gabungan, $stat['mean']['penghasilan_gabungan'], $stat['std_dev']['penghasilan_gabungan']);
                $probBesaranPdam = $this->naiveBayesProb($mhs->besaran_pdam, $stat['mean']['besaran_pdam'], $stat['std_dev']['besaran_pdam']);
                $probBesaranPln = $this->naiveBayesProb($mhs->besaran_pln, $stat['mean']['besaran_pln'], $stat['std_dev']['besaran_pln']);
                $probPajakMotor = $this->naiveBayesProb($mhs->pajak_motor, $stat['mean']['pajak_motor'], $stat['std_dev']['pajak_motor']);

                $totalProb = $probJmlTanggungan * $probAnakDiTanggung * $probPenghasilanAyah * $probPenghasilanIbu * $probPenghasilanGabungan * $probBesaranPdam * $probBesaranPln * $probPajakMotor;

                if ($totalProb > $maxProb) {
                    $maxProb = $totalProb;
                    $maxKelompok = $kelompokUkt;
                }
            }

            $programStudi = $mhs->programStudi;
            $kelompokUkt = KelompokUkt::where('id_program_studi', $programStudi->id)
                ->where('nama_kelompok_ukt', $maxKelompok)
                ->first();

            if ($kelompokUkt) {
                $mhs->id_kelompok_ukt_baru = $kelompokUkt->id;
                $mhs->save();
            }

            $finalResults[] = [
                'id_mahasiswa' => $mhs->id,
                'kelompok_ukt' => $maxKelompok,
                'total_prob' => $maxProb
            ];
        }

        return response()->json([
            'message' => 'Mean, standard deviation, and Naive Bayes probabilities calculated for each UKT group.',
            'results' => [
                'stats' => $stats,
                'final_results' => $finalResults
            ]
        ]);
    }

    public function mean($data, $key)
    {
        return array_sum(array_column($data, $key)) / count($data);
    }

    public function standardDeviation($data, $key, $mean)
    {
        $n = count($data);
        if ($n <= 1) {
            return 0;
        }

        $temp = array_column($data, $key);
        $variance = array_map(function ($val) use ($mean) {
            return pow(($val - $mean), 2);
        }, $temp);

        return sqrt(array_sum($variance) / ($n - 1));
    }

    public function naiveBayesProb($data, $mean, $stdDev)
    {
        if ($stdDev == 0) {
            $stdDev = 1e-10;
        }

        $exponent = exp(-pow($data - $mean, 2) / (2 * pow($stdDev, 2)));
        return (1 / (sqrt(2 * pi()) * $stdDev)) * $exponent;
    }


    public function details($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('Perhitungan.details', compact('mahasiswa'))->render();
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi_perhitungan' => 'required|in:Diverifikasi,Pending,Ditolak'
        ]);

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->status_verifikasi_perhitungan = $request->status_verifikasi_perhitungan;

            if ($request->status_verifikasi_perhitungan === 'Diverifikasi') {
                $kelompokUktBaru = $mahasiswa->kelompokUktBaru ? $mahasiswa->kelompokUktBaru->nama_kelompok_ukt : 'Tidak diketahui';

                $historiPerhitungan = "- Kelompok UKT baru: {$kelompokUktBaru}<br>";
                $historiPerhitungan .= "- Status: Terverifikasi";

                $mahasiswa->histori_perhitungan_mahasiswa = $historiPerhitungan;
            } elseif ($request->status_verifikasi_perhitungan === 'Ditolak') {
                $kelompokUkt = $mahasiswa->kelompokUkt ? $mahasiswa->kelompokUkt->nama_kelompok_ukt : 'Tidak diketahui';

                $historiPerhitungan = "- Kelompok UKT Tetap: {$kelompokUkt} <br>";
                $historiPerhitungan .= "- Status: Ditolak perhitungan";

                $mahasiswa->histori_perhitungan_mahasiswa = $historiPerhitungan;
            } else {
                $mahasiswa->histori_perhitungan_mahasiswa = null;
            }

            $mahasiswa->save();

            return response()->json(['success' => 'Status verifikasi berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function create()
    {
        // Tidak Dipakai
    }

    public function store()
    {
        // Tidak Dipakai
    }

    public function show()
    {
        // Tidak Dipakai
    }

    public function edit()
    {
        // Tidak Dipakai
    }

    public function update()
    {
        // Tidak Dipakai
    }

    public function destroy()
    {
        // Tidak Dipakai
    }
}
