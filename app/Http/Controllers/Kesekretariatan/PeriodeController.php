<?php

namespace App\Http\Controllers\Kesekretariatan;

use App\DataTables\Kesekretariatan\PeriodeDataTables;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index(PeriodeDataTables $dataTable)
    {
        return $dataTable->render('Kesekretariatan.periode.index');
    }

    public function create()
    {
        //Tidak Dipakai
    }

    public function store(Request $request)
    {
        $messages = [
            'nama_periode.required' => 'Nama periode wajib diisi.',
            'nama_periode.string' => 'Nama periode harus berupa teks.',
            'nama_periode.max' => 'Nama periode maksimal 255 karakter.',
            'status_periode.required' => 'Status periode wajib diisi.',
            'status_periode.in' => 'Status periode harus salah satu dari: Aktif atau Tidak Aktif.',
            'tanggal_mulai_periode.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai_periode.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_mulai_periode.before_or_equal' => 'Tanggal mulai harus sebelum atau sama dengan tanggal selesai.',
            'tanggal_akhir_periode.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_akhir_periode.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_akhir_periode.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ];

        $validatedData = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'status_periode' => 'required|in:Aktif,Tidak Aktif',
            'tanggal_mulai_periode' => 'required|date|before_or_equal:tanggal_akhir_periode',
            'tanggal_akhir_periode' => 'required|date|after_or_equal:tanggal_mulai_periode',
        ], $messages);

        if ($validatedData['status_periode'] === 'Aktif' && Periode::where('status_periode', 'Aktif')->exists()) {
            return response()->json(['error' => 'Sudah ada periode yang aktif. Hanya satu periode yang bisa aktif pada satu waktu.'], 422);
        }

        try {
            Periode::create($validatedData);

            return response()->json(['success' => 'Periode berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $periode = Periode::findOrFail($id);

            $periode->tanggal_mulai_periode = \Carbon\Carbon::parse($periode->tanggal_mulai_periode)->format('Y-m-d\TH:i');
            $periode->tanggal_akhir_periode = \Carbon\Carbon::parse($periode->tanggal_akhir_periode)->format('Y-m-d\TH:i');

            return response()->json($periode);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Periode not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while retrieving the periode data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function edit(Periode $periode)
    {
        //Tidak Dipakai
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'nama_periode.required' => 'Nama periode wajib diisi.',
            'nama_periode.string' => 'Nama periode harus berupa teks.',
            'nama_periode.max' => 'Nama periode maksimal 255 karakter.',
            'status_periode.required' => 'Status periode wajib diisi.',
            'status_periode.in' => 'Status periode harus salah satu dari: Aktif atau Tidak Aktif.',
            'tanggal_mulai_periode.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai_periode.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_mulai_periode.before_or_equal' => 'Tanggal mulai harus sebelum atau sama dengan tanggal selesai.',
            'tanggal_akhir_periode.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_akhir_periode.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_akhir_periode.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ];

        $validatedData = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'status_periode' => 'required|in:Aktif,Tidak Aktif',
            'tanggal_mulai_periode' => 'required|date|before_or_equal:tanggal_akhir_periode',
            'tanggal_akhir_periode' => 'required|date|after_or_equal:tanggal_mulai_periode',
        ], $messages);

        if ($validatedData['status_periode'] === 'Aktif' && Periode::where('status_periode', 'Aktif')->where('id', '!=', $id)->exists()) {
            return response()->json(['error' => 'Sudah ada periode yang aktif. Hanya satu periode yang bisa aktif pada satu waktu.'], 422);
        }

        if ($request->status_periode === 'Tidak Aktif' && Mahasiswa::where('id_periode', $id)->where('status_verifikasi', '=', 'Proses Diverifikasi')->exists()) {
            return response()->json(['error' => 'Tidak bisa menonaktifkan periode karena ada mahasiswa yang statusnya masih Proses Diverifikasi'], 422);
        }

        try {
            $periode = Periode::findOrFail($id);
            $periode->update($validatedData);

            return response()->json(['success' => 'Periode berhasil diupdate!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(Periode $periode)
    {
        if ($periode->status_periode === 'Aktif') {
            return response()->json([
                'error' => true,
                'message' => 'Periode dengan status "Aktif" tidak dapat dihapus.'
            ]);
        }

        try {
            $periode->delete();
            return response()->json(['success' => true, 'message' => 'Sukses menghapus data periode.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data periode tidak bisa dihapus karena terikat dengan kolom lain.'
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data periode.']);
            }
        }
    }
}
