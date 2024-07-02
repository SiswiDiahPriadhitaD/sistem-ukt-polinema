<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Periode;
use App\Models\ProgramStudi;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontEndController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest_or_user')->only(['index']);
        $this->middleware(['auth', 'role:mahasiswa'])->only(['biodata', 'biodataStore', 'biodataPendukung']);
    }

    public function index()
    {
        $periode = Periode::where('status_periode', '=', 'Aktif')->first();

        if ($periode) {
            $periode->tanggal_mulai_periode = \Carbon\Carbon::parse($periode->tanggal_mulai_periode)->locale('id')->isoFormat('DD MMMM YYYY');
            $periode->tanggal_akhir_periode = \Carbon\Carbon::parse($periode->tanggal_akhir_periode)->locale('id')->isoFormat('DD MMMM YYYY');
        }

        return view('front-end.index')->with([
            'periode' => $periode
        ]);
    }

    public function biodata()
    {
        $programStudi = ProgramStudi::select(
            'program_studi.id',
            'program_studi.nama_program_studi',
            'program_studi.jenjang_pendidikan',
            'jurusan.nama_jurusan'
        )
            ->leftJoin('jurusan', 'program_studi.id_jurusan', '=', 'jurusan.id')
            ->orderBy(
                'jurusan.nama_jurusan',
                'asc'
            )
            ->get();
        $biodata = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $periodeAktif = Periode::where('status_periode', 'Aktif')->first();

        return view('front-end.index-biodata')->with([
            'biodata' => $biodata,
            'programStudi' => $programStudi,
            'periodeAktif' => $periodeAktif
        ]);
    }

    public function biodataStore(Request $request)
    {
        $userId = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('id_user', $userId)->first();
        $periodeAktif = Periode::where('status_periode', 'Aktif')->first();
        $messages = [
            'foto_mahasiswa.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_mahasiswa.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_mahasiswa.max' => 'Ukuran foto maksimal 2 MB.',
            'nama_mahasiswa.required' => 'Nama mahasiswa wajib diisi.',
            'nama_mahasiswa.max' => 'Nama mahasiswa maksimal 255 karakter.',
            'nim_mahasiswa.required' => 'NIM mahasiswa wajib diisi.',
            'nim_mahasiswa.numeric' => 'NIM mahasiswa harus berupa angka.',
            'nim_mahasiswa.unique' => 'NIM mahasiswa sudah terdaftar.',
            'angkatan_mahasiswa.required' => 'Tahun angkatan wajib diisi.',
            'angkatan_mahasiswa.numeric' => 'Tahun angkatan harus berupa angka.',
            'angkatan_mahasiswa.digits' => 'Tahun angkatan harus 4 digit.',
            'semester_mahasiswa.required' => 'Semester wajib diisi.',
            'semester_mahasiswa.in' => 'Semester yang dipilih tidak valid.',
            'id_program_studi.required' => 'Program studi wajib dipilih.',
            'id_program_studi.exists' => 'Program studi yang dipilih tidak valid.',
            'jalur_masuk.required' => 'Jalur masuk wajib dipilih.',
            'jalur_masuk.in' => 'Jalur masuk yang dipilih tidak valid.',
        ];

        if (!$mahasiswa) {
            $validatedData = $request->validate([
                'foto_mahasiswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'nama_mahasiswa' => 'required|string|max:255',
                'nim_mahasiswa' => 'required|numeric|unique:mahasiswa,nim_mahasiswa',
                'angkatan_mahasiswa' => 'required|numeric|digits:4',
                'semester_mahasiswa' => 'required|in:ganjil,genap',
                'id_program_studi' => 'required|exists:program_studi,id',
                'jalur_masuk' => 'required|in:PSB/PMDK/SNMPN/SNMPTN,UMPN PSDKU,UMPN/SBMPN/SBMPTN,Mandiri',
            ], $messages);
        } else {
            $validatedData = $request->validate([
                'foto_mahasiswa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'nama_mahasiswa' => 'required|string|max:255',
                'nim_mahasiswa' => 'required|numeric|unique:mahasiswa,nim_mahasiswa,' . $mahasiswa->id,
                'angkatan_mahasiswa' => 'required|numeric|digits:4',
                'semester_mahasiswa' => 'required|in:ganjil,genap',
                'id_program_studi' => 'required|exists:program_studi,id',
                'jalur_masuk' => 'required|in:PSB/PMDK/SNMPN/SNMPTN,UMPN PSDKU,UMPN/SBMPN/SBMPTN,Mandiri',
            ], $messages);
        }

        if ($request->hasFile('foto_mahasiswa')) {
            $fotoPath = $request->file('foto_mahasiswa')->store('foto_mahasiswa', 'public');
            $validatedData['foto_mahasiswa'] = $fotoPath;
        }

        $jenjangMahasiswa = null;
        if ($request->has('id_program_studi')) {
            $programStudi = ProgramStudi::find($request->id_program_studi);
            if ($programStudi->jenjang_pendidikan == 'D-III') {
                $jenjangMahasiswa = 'E';
            } elseif ($programStudi->jenjang_pendidikan == 'D-IV') {
                $jenjangMahasiswa = 'D';
            }
        }

        $currentYear = now()->year;
        $semesterString = $request->semester_mahasiswa == 'ganjil' ? $currentYear . '1' : $currentYear . '2';

        if ($mahasiswa) {
            // Update existing mahasiswa
            $mahasiswa->update(array_merge($validatedData, ['semester_mahasiswa' => $semesterString, 'jenjang_mahasiswa' => $jenjangMahasiswa, 'status_verifikasi' => 'Proses Diverifikasi']));
        } else {
            // Create new mahasiswa
            Mahasiswa::create(array_merge($validatedData, [
                'id_user' => $userId,
                'id_periode' => $periodeAktif->id,
                'semester_mahasiswa' => $semesterString,
                'jenjang_mahasiswa' => $jenjangMahasiswa
            ]));
        }

        return redirect()->back()->with('success', 'Biodata berhasil disimpan.');
    }





    public function biodataPendukung()
    {
        $biodata = Mahasiswa::where('id_user', Auth::user()->id)->first();
        $periodeAktif = Periode::where('status_periode', 'Aktif')->first();

        if (!$biodata) {
            return redirect()->route('front-end.biodata')->with('error', 'Biodata tidak ditemukan.');
        }

        return view('front-end.index-pendukung')->with([
            'biodata' => $biodata,
            'periodeAktif' => $periodeAktif
        ]);
    }

    public function biodataPendukungStore(Request $request)
    {
        $user = auth()->user();
        $periodeAktif = Periode::where('status_periode', 'Aktif')->first();

        $messages = [
            'alamat_ortu.required' => 'Alamat orang tua wajib diisi.',
            'alamat_ortu.max' => 'Alamat orang tua maksimal 255 karakter.',
            'no_hp_aktif.regex' => 'Nomor HP aktif tidak valid.',
            'no_telp_ayah.regex' => 'Nomor telepon ayah tidak valid.',
            'status_ortu.required' => 'Status orang tua wajib dipilih.',
            'pekerjaan_ayah.required' => 'Pekerjaan ayah wajib diisi.',
            'pekerjaan_ayah.max' => 'Pekerjaan ayah maksimal 50 karakter.',
            'pekerjaan_ibu.required' => 'Pekerjaan ibu wajib diisi.',
            'pekerjaan_ibu.max' => 'Pekerjaan ibu maksimal 50 karakter.',
            'jml_tanggungan.required' => 'Jumlah tanggungan wajib diisi.',
            'jml_tanggungan.integer' => 'Jumlah tanggungan harus berupa angka.',
            'anak_di_tanggung.required' => 'Jumlah anak yang ditanggung wajib diisi.',
            'anak_di_tanggung.integer' => 'Jumlah anak yang ditanggung harus berupa angka.',
            'penghasilan_ayah.required' => 'Penghasilan ayah wajib diisi.',
            'penghasilan_ayah.numeric' => 'Penghasilan ayah harus berupa angka.',
            'penghasilan_ibu.required' => 'Penghasilan ibu wajib diisi.',
            'penghasilan_ibu.numeric' => 'Penghasilan ibu harus berupa angka.',
            'penghasilan_gabungan.required' => 'Penghasilan gabungan wajib diisi.',
            'penghasilan_gabungan.numeric' => 'Penghasilan gabungan harus berupa angka.',
            'besaran_pln.required' => 'Besaran PLN wajib diisi.',
            'besaran_pln.numeric' => 'Besaran PLN harus berupa angka.',
            'besaran_pdam.required' => 'Besaran PDAM wajib diisi.',
            'besaran_pdam.numeric' => 'Besaran PDAM harus berupa angka.',
            'pajak_mobil.required' => 'Pajak mobil wajib diisi.',
            'pajak_mobil.numeric' => 'Pajak mobil harus berupa angka.',
            'pajak_motor.required' => 'Pajak motor wajib diisi.',
            'pajak_motor.numeric' => 'Pajak motor harus berupa angka.',
            'foto_pekerjaan_ayah.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_pekerjaan_ayah.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_pekerjaan_ibu.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_pekerjaan_ibu.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_keluarga.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_keluarga.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_penghasilan_ayah.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_penghasilan_ayah.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_penghasilan_ibu.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_penghasilan_ibu.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_penghasilan_gabungan.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_penghasilan_gabungan.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_pembayaran_pln.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_pembayaran_pln.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_pembayaran_pdam.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_pembayaran_pdam.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_pajak_mobil.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_pajak_mobil.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
            'foto_pajak_motor.image' => 'Foto harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'foto_pajak_motor.mimes' => 'Foto harus memiliki ekstensi jpeg, png, atau jpg.',
        ];

        $validatedData = $request->validate([
            'alamat_ortu' => 'nullable|string|max:255',
            'no_hp_aktif' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',
            'no_telp_ayah' => 'nullable|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,8}$/',
            'status_ortu' => 'nullable|in:Janda,Duda,Lengkap',
            'pekerjaan_ayah' => 'nullable|string|max:50',
            'pekerjaan_ibu' => 'nullable|string|max:50',
            'jml_tanggungan' => 'nullable|integer',
            'anak_di_tanggung' => 'nullable|integer',
            'penghasilan_ayah' => 'nullable|numeric',
            'penghasilan_ibu' => 'nullable|numeric',
            'penghasilan_gabungan' => 'nullable|numeric',
            'besaran_pln' => 'nullable|numeric',
            'besaran_pdam' => 'nullable|numeric',
            'pajak_mobil' => 'nullable|numeric',
            'pajak_motor' => 'nullable|numeric',
            'foto_pekerjaan_ayah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pekerjaan_ibu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_keluarga' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_penghasilan_ayah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_penghasilan_ibu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_penghasilan_gabungan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pembayaran_pln' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pembayaran_pdam' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pajak_mobil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_pajak_motor' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], $messages);

        $fotoFields = [
            'foto_pekerjaan_ayah',
            'foto_pekerjaan_ibu',
            'foto_keluarga',
            'foto_penghasilan_ayah',
            'foto_penghasilan_ibu',
            'foto_penghasilan_gabungan',
            'foto_pembayaran_pln',
            'foto_pembayaran_pdam',
            'foto_pajak_mobil',
            'foto_pajak_motor'
        ];

        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $fotoPath = $request->file($field)->storeAs(
                    'foto_pendukung/' . $user->name,
                    $request->file($field)->getClientOriginalName(),
                    'public'
                );
                $validatedData[$field] = $fotoPath;
            }
        }

        $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();

        if ($mahasiswa) {
            // Update existing mahasiswa
            if ($mahasiswa->id_periode != $periodeAktif->id) {
                $validatedData['status_verifikasi'] = 'Proses Diverifikasi';
                $validatedData['id_periode'] = $periodeAktif->id;
            } elseif ($mahasiswa->status_verifikasi == 'Pending') {
                $validatedData['status_verifikasi'] = 'Proses Diverifikasi';
            }
            $mahasiswa->update($validatedData);
        } else {
            // Create new mahasiswa
            $validatedData['id_user'] = $user->id;
            $validatedData['id_periode'] = $periodeAktif->id;
            $validatedData['status_verifikasi'] = 'Proses Diverifikasi';
            $mahasiswa = Mahasiswa::create($validatedData);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }


    public function pengumuman()
    {
        $id = Auth::user()->id;
        $mahasiswa = Mahasiswa::with('kelompokUktBaru')->where('id_user', $id)->first();
        return view('front-end.pengumuman')->with(['mahasiswa' => $mahasiswa]);
    }
}
