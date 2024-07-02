<?php

namespace App\Http\Controllers\Kesekretariatan;

use App\DataTables\Kesekretariatan\ProgramStudiDataTables;
use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index(ProgramStudiDataTables $dataTable)
    {
        return $dataTable->render('Kesekretariatan.programStudi.index');
    }

    public function create()
    {
        //Tidak Dipakai
    }

    public function store(Request $request)
    {
        $messages = [
            'id_jurusan.required' => 'Jurusan harus diisi.',
            'id_jurusan.exists' => 'Jurusan tidak ditemukan.',
            'nama_program_studi.required' => 'Nama Program Studi harus diisi.',
            'nama_program_studi.string' => 'Nama Program Studi harus berupa string.',
            'jenjang_pendidikan.required' => 'Jenjang Pendidikan harus diisi.',
            'jenjang_pendidikan.in' => 'Jenjang Pendidikan harus salah satu dari: D2, D3, D4.',
            'unique_combination' => 'Kombinasi Jenjang Pendidikan dan Nama Program Studi ini sudah ada.'
        ];

        $validatedData = $request->validate([
            'id_jurusan' => 'required|exists:jurusan,id',
            'nama_program_studi' => 'required|string',
            'jenjang_pendidikan' => 'required|in:D-II,D-III,D-IV',
        ], $messages);

        $existingProgramStudi = ProgramStudi::where('nama_program_studi', $request->nama_program_studi)
            ->where('jenjang_pendidikan', $request->jenjang_pendidikan)
            ->first();

        if ($existingProgramStudi) {
            return response()->json(['error' => $messages['unique_combination']], 422);
        }

        try {
            ProgramStudi::create($validatedData);

            return response()->json(['success' => 'Program Studi berhasil ditambahkan!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try {
            $programStudi = ProgramStudi::findOrFail($id);

            return response()->json($programStudi);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Program Studi Tidak Ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error saat mengambil Program Studi data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function edit(ProgramStudi $programStudi)
    {
        //Tidak Dipakai
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'id_jurusan.required' => 'Jurusan harus diisi.',
            'id_jurusan.exists' => 'Jurusan tidak ditemukan.',
            'nama_program_studi.required' => 'Nama Program Studi harus diisi.',
            'nama_program_studi.string' => 'Nama Program Studi harus berupa string.',
            'jenjang_pendidikan.required' => 'Jenjang Pendidikan harus diisi.',
            'jenjang_pendidikan.in' => 'Jenjang Pendidikan harus salah satu dari: D-II,D-III,D-IV.',
            'unique_combination' => 'Kombinasi Jenjang Pendidikan dan Nama Program Studi ini sudah ada.'
        ];

        $validatedData = $request->validate([
            'id_jurusan' => 'required|exists:jurusan,id',
            'nama_program_studi' => 'required|string',
            'jenjang_pendidikan' => 'required|in:D-II,D-III,D-IV',
        ], $messages);

        $existingProgramStudi = ProgramStudi::where('nama_program_studi', $request->nama_program_studi)
            ->where('jenjang_pendidikan', $request->jenjang_pendidikan)
            ->where('id', '!=', $id)
            ->first();

        if ($existingProgramStudi) {
            return response()->json(['error' => $messages['unique_combination']], 422);
        }

        try {
            $programStudi = ProgramStudi::findOrFail($id);
            $programStudi->update($validatedData);

            return response()->json(['success' => 'Program Studi berhasil diupdate!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(ProgramStudi $programStudi)
    {
        try {
            $programStudi->delete();
            return response()->json(['success' => true, 'message' => 'Sukses menghapus data Program Studi.']);
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data Program Studi tidak bisa dihapus karena terikat dengan kolom lain.'
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data Program Studi.']);
            }
        }
    }

    public function list()
    {
        try {
            $programStudi = ProgramStudi::all();
            return response()->json($programStudi);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to retrieve Program Studi data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function listToMahasiswa()
    {
        try {
            $programStudi = ProgramStudi::select(
                'program_studi.id',
                'program_studi.nama_program_studi',
                'program_studi.jenjang_pendidikan',
                'jurusan.nama_jurusan'
            )
                ->leftJoin('jurusan', 'program_studi.id_jurusan', '=', 'jurusan.id')
                ->orderBy('jurusan.nama_jurusan')
                ->get();
            return response()->json($programStudi);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to retrieve Program Studi data.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
