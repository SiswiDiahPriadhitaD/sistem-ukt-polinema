<?php

namespace App\Http\Controllers\Kesekretariatan;

use App\DataTables\Kesekretariatan\JurusanDataTables;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(JurusanDataTables $dataTable)
    {
        return $dataTable->render('Kesekretariatan.jurusan.index');
    }

    public function create()
    {
        //Tidak Dipakai
    }

    public function store(Request $request)
    {
        $messages = [
            'nama_jurusan.required' => 'Nama Jurusan wajib diisi.',
            'nama_jurusan.string' => 'Nama Jurusan harus berupa teks.',
            'nama_jurusan.unique' => 'Nama Jurusan sudah terdaftar.',
        ];

        $validatedData = $request->validate([
            'nama_jurusan' => 'required|string|unique:jurusan,nama_jurusan',
        ], $messages);

        try {
            Jurusan::create($validatedData);

            return response()->json(['success' => 'Jurusan berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $jurusan = Jurusan::findOrFail($id);

            return response()->json($jurusan);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Jurusan Tidak Ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error saat mengambil Jurusan data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function edit(Jurusan $jurusan)
    {
        //Tidak Dipakai
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'nama_jurusan.required' => 'Nama Jurusan wajib diisi.',
            'nama_jurusan.string' => 'Nama Jurusan harus berupa teks.',
            'nama_jurusan.unique' => 'Nama Jurusan sudah terdaftar.',
        ];

        $validatedData = $request->validate([
            'nama_jurusan' => 'required|string|unique:jurusan,nama_jurusan,' . $id,
        ], $messages);

        try {
            $jurusan = Jurusan::findOrFail($id);
            $jurusan->update($validatedData);

            return response()->json(['success' => 'Kelompok berhasil diupdate!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(Jurusan $jurusan)
    {
        try {
            $jurusan->delete();
            return response()->json(['success' => true, 'message' => 'Sukses menghapus data Jurusan.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data Jurusan tidak bisa dihapus karena terikat dengan kolom lain.'
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data Jurusan.']);
            }
        }
    }

    public function list()
    {
        try {
            $jurusan = Jurusan::all();
            return response()->json($jurusan);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to retrieve Jurusan data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
