<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\DataTables\Kemahasiswaan\MahasiswaDataTables;
use App\Http\Controllers\Controller;
use App\Imports\MahasiswaImport;
use App\Models\Jurusan;
use App\Models\KelompokUkt;
use App\Models\Mahasiswa;
use App\Models\Periode;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function index(MahasiswaDataTables $dataTable)
    {
        return $dataTable->render('Kemahasiswaan.mahasiswa.index');
    }

    public function store(Request $request)
    {

        $periodeAktif = Periode::where('status_periode', 'Aktif')->first();

        $messages = [
            'nama_mahasiswa.required' => 'Nama mahasiswa wajib diisi.',
            'nama_mahasiswa.max' => 'Nama mahasiswa maksimal 255 karakter.',
            'nim_mahasiswa.required' => 'NIM mahasiswa wajib diisi.',
            'nim_mahasiswa.numeric' => 'NIM mahasiswa harus berupa angka.',
            'nim_mahasiswa.unique' => 'NIM mahasiswa sudah terdaftar.',
            'angkatan_mahasiswa.required' => 'Tahun angkatan wajib diisi.',
            'angkatan_mahasiswa.numeric' => 'Tahun angkatan harus berupa angka.',
            'angkatan_mahasiswa.digits' => 'Tahun angkatan harus 4 digit.',
            'semester_mahasiswa.required' => 'Semester wajib dipilih.',
            'semester_mahasiswa.in' => 'Semester yang dipilih tidak valid.',
            'id_program_studi.required' => 'Program studi wajib dipilih.',
            'id_program_studi.exists' => 'Program studi yang dipilih tidak valid.',
            'id_kelompok_ukt.required' => 'Kelompok ukt wajib dipilih.',
            'jalur_masuk.string' => 'Jalur masuk harus berupa teks.',
            'jalur_masuk.max' => 'Jalur masuk maksimal 255 karakter.',
        ];

        $validatedData = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim_mahasiswa' => 'required|numeric|unique:mahasiswa,nim_mahasiswa',
            'angkatan_mahasiswa' => 'required|numeric|digits:4',
            'semester_mahasiswa' => 'required|in:ganjil,genap',
            'id_program_studi' => 'required|exists:program_studi,id',
            'id_kelompok_ukt' => 'required|exists:kelompok_ukt,id',
            'jalur_masuk' => 'nullable|string|max:255',
        ], $messages);

        $jenjangMahasiswa = null;
        if ($request->has('id_program_studi')) {
            $programStudi = ProgramStudi::find($request->id_program_studi);
            if ($programStudi->jenjang_pendidikan == 'D-III') {
                $jenjangMahasiswa = 'E';
            } elseif ($programStudi->jenjang_pendidikan == 'D-IV') {
                $jenjangMahasiswa = 'D';
            }
        }

        // Proses semester_mahasiswa
        $currentYear = now()->year;
        $semesterValue = $request->semester_mahasiswa == 'ganjil' ? $currentYear . '1' : $currentYear . '2';

        try {
            $user = User::create([
                'name' => $request->nama_mahasiswa,
                'username' => $request->nim_mahasiswa,
                'password' => Hash::make($request->nim_mahasiswa),
                'email_verified_at' => now(),
            ]);

            $user->assignRole('mahasiswa');

            Mahasiswa::create(array_merge($validatedData, [
                'id_user' => $user->id,
                'id_periode' => $periodeAktif->id,
                'jenjang_mahasiswa' => $jenjangMahasiswa,
                'semester_mahasiswa' => $semesterValue,  // Simpan semester dengan nilai yang sudah diproses
            ]));

            return response()->json(['success' => 'Mahasiswa berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }


    public function create()
    {
        //Tidak Dipakai
    }

    public function show($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            return response()->json($mahasiswa);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Mahasiswa Tidak Ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error saat mengambil Mahasiswa data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function details($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('Kemahasiswaan.mahasiswa.details', compact('mahasiswa'))->render();
    }




    public function edit(Jurusan $jurusan)
    {
        //Tidak Dipakai
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'nama_mahasiswa.required' => 'Nama mahasiswa wajib diisi.',
            'nama_mahasiswa.max' => 'Nama mahasiswa maksimal 255 karakter.',
            'nim_mahasiswa.required' => 'NIM wajib diisi.',
            'nim_mahasiswa.numeric' => 'NIM harus berupa angka.',
            'nim_mahasiswa.unique' => 'NIM sudah terdaftar.',
            'angkatan_mahasiswa.required' => 'Tahun angkatan wajib diisi.',
            'angkatan_mahasiswa.numeric' => 'Tahun angkatan harus berupa angka.',
            'angkatan_mahasiswa.digits' => 'Tahun angkatan harus 4 digit.',
            'semester_mahasiswa.required' => 'Semester wajib diisi.',
            'semester_mahasiswa.in' => 'Semester yang dipilih tidak valid.',
            'id_program_studi.required' => 'Program studi wajib dipilih.',
            'id_program_studi.exists' => 'Program studi yang dipilih tidak valid.',
            'id_kelompok_ukt.required' => 'Kelompok ukt wajib dipilih.',
            'jalur_masuk.required' => 'Jalur masuk wajib dipilih.',
            'jalur_masuk.in' => 'Jalur masuk yang dipilih tidak valid.',
        ];

        $validatedData = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim_mahasiswa' => 'required|numeric|unique:mahasiswa,nim_mahasiswa,' . $id,
            'angkatan_mahasiswa' => 'required|numeric|digits:4',
            'semester_mahasiswa' => 'required|in:ganjil,genap',
            'id_program_studi' => 'required|exists:program_studi,id',
            'id_kelompok_ukt' => 'required|exists:kelompok_ukt,id',
            'jalur_masuk' => 'required|in:PSB/PMDK/SNMPN/SNMPTN,UMPN PSDKU,UMPN/SBMPN/SBMPTN,Mandiri',
        ], $messages);

        $jenjangMahasiswa = null;
        if ($request->has('id_program_studi')) {
            $programStudi = ProgramStudi::find($request->id_program_studi);
            if ($programStudi->jenjang_pendidikan == 'D-III') {
                $jenjangMahasiswa = 'E';
            } elseif ($programStudi->jenjang_pendidikan == 'D-IV') {
                $jenjangMahasiswa = 'D';
            }
        }

        // Proses semester_mahasiswa
        $currentYear = now()->year;
        $semesterValue = $request->semester_mahasiswa == 'ganjil' ? $currentYear . '1' : $currentYear . '2';

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->update(array_merge($validatedData, [
                'jenjang_mahasiswa' => $jenjangMahasiswa,
                'semester_mahasiswa' => $semesterValue
            ]));

            return response()->json(['success' => 'Mahasiswa berhasil diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }



    public function destroy(Mahasiswa $mahasiswa)
    {
        try {
            $mahasiswa->delete();
            $user = User::where('id', $mahasiswa->id_user)->first();
            $user->forceDelete();
            return response()->json(['success' => true, 'message' => 'Sukses menghapus data Mahasiswa.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data Mahasiswa tidak bisa dihapus karena terikat dengan kolom lain.'
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data Mahasiswa.']);
            }
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Diverifikasi,Proses Diverifikasi,Ditolak'
        ]);

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->status_verifikasi = $request->status_verifikasi;
            $mahasiswa->save();

            return response()->json(['success' => 'Status verifikasi berhasil diubah!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function import(Request $request)
    {
        Excel::import(new MahasiswaImport, $request->file('import-file')->store('import-files'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Diimport');
    }

    public function getKelompokUktByProgramStudi($id)
    {
        $kelompokUkt = KelompokUkt::where('id_program_studi', $id)->get();
        return response()->json($kelompokUkt);
    }
}