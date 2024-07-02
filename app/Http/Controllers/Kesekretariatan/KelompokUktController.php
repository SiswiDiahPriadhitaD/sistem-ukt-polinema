<?php

namespace App\Http\Controllers\Kesekretariatan;

use App\DataTables\Kesekretariatan\KelompokUktDataTables;
use App\Http\Controllers\Controller;
use App\Models\KelompokUkt;
use Illuminate\Http\Request;

class KelompokUktController extends Controller
{
    public function index(KelompokUktDataTables $dataTable)
    {
        return $dataTable->render('Kesekretariatan.kelompokUkt.index');
    }

    public function create()
    {
        //Tidak Dipakai
    }

    public function store(Request $request)
    {
        $messages = [
            'id_program_studi.required' => 'Program Studi wajib diisi.',
            'id_program_studi.exists' => 'Program Studi tidak valid.',
            'nama_kelompok_ukt.required' => 'Nama Kelompok Ukt wajib diisi.',
            'nama_kelompok_ukt.string' => 'Nama Kelompok Ukt harus berupa teks.',
            'nama_kelompok_ukt.max' => 'Nama Kelompok Ukt maksimal 2 karakter.',
            'nama_kelompok_ukt.unique' => 'Nama Kelompok Ukt sudah terdaftar untuk Program Studi ini.',
            'nominal_kelompok_ukt.required' => 'Nominal Kelompok Ukt wajib diisi.',
            'nominal_kelompok_ukt.numeric' => 'Nominal Kelompok Ukt harus berupa angka.',
        ];

        $validatedData = $request->validate([
            'id_program_studi' => 'required|exists:program_studi,id',
            'nama_kelompok_ukt' => 'required|string|max:3|unique:kelompok_ukt,nama_kelompok_ukt,NULL,id,id_program_studi,' . $request->id_program_studi,
            'nominal_kelompok_ukt' => 'required|numeric',
        ], $messages);

        try {
            KelompokUkt::create($validatedData);

            return response()->json(['success' => 'Kelompok Ukt berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try {
            $kelompokUkt = KelompokUkt::findOrFail($id);

            return response()->json($kelompokUkt);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Kelompok Ukt Tidak Ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error saat mengambil Kelompok Ukt data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function edit(KelompokUkt $kelompokUkt)
    {
        //Tidak Dipakai
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'id_program_studi.required' => 'Program Studi wajib diisi.',
            'id_program_studi.exists' => 'Program Studi tidak valid.',
            'nama_kelompok_ukt.required' => 'Nama Kelompok Ukt wajib diisi.',
            'nama_kelompok_ukt.string' => 'Nama Kelompok Ukt harus berupa teks.',
            'nama_kelompok_ukt.max' => 'Nama Kelompok Ukt maksimal 3 karakter.',
            'nama_kelompok_ukt.unique' => 'Nama Kelompok Ukt sudah terdaftar untuk Program Studi ini.',
            'nominal_kelompok_ukt.required' => 'Nominal Kelompok Ukt wajib diisi.',
            'nominal_kelompok_ukt.numeric' => 'Nominal Kelompok Ukt harus berupa angka.',
        ];

        $validatedData = $request->validate([
            'id_program_studi' => 'required|exists:program_studi,id',
            'nama_kelompok_ukt' => 'required|string|max:3|unique:kelompok_ukt,nama_kelompok_ukt,' . $id . ',id,id_program_studi,' . $request->id_program_studi,
            'nominal_kelompok_ukt' => 'required|numeric',
        ], $messages);

        try {
            $kelompokUkt = KelompokUkt::findOrFail($id);
            $kelompokUkt->update($validatedData);

            return response()->json(['success' => 'Kelompok Ukt berhasil diupdate!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }



    public function destroy(KelompokUkt $kelompokUkt)
    {
        try {
            $kelompokUkt->delete();
            return response()->json(['success' => true, 'message' => 'Sukses menghapus data Kelompok Ukt.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data Kelompok Ukt tidak bisa dihapus karena terikat dengan kolom lain.'
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data Kelompok Ukt.']);
            }
        }
    }

    
}
