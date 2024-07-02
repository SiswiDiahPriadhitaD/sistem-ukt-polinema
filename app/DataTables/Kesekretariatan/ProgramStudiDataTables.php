<?php

namespace App\DataTables\Kesekretariatan;

use App\Models\ProgramStudi;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProgramStudiDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->addColumn('jurusan', function ($row) {
                return $row->nama_jurusan ?? '-';
            })
            ->addColumn('action', function ($row) {
                $editBtn = '<button onclick="editProgramStudi(' . $row->id . ')" class="edit btn btn-primary btn-sm mr-1">Ubah</button>';
                $deleteBtn = '<button onclick="confirmDelete(' . $row->id . ')" class="btn btn-danger btn-sm">Hapus</button>';
                return '<div class="text-center">' . $editBtn . $deleteBtn . '</div>';
            })
            ->rawColumns(['action']);
    }

    public function query(ProgramStudi $model)
    {
        return $model->newQuery()->select(
            'program_studi.id',
            'program_studi.id_jurusan',
            'program_studi.jenjang_pendidikan',
            'program_studi.nama_program_studi',
            'jurusan.nama_jurusan'
        )
            ->join('jurusan', 'program_studi.id_jurusan', '=', 'jurusan.id');
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'jurusan', 'name' => 'jurusan.nama_jurusan', 'title' => 'Nama Jurusan'],
                ['data' => 'jenjang_pendidikan', 'name' => 'jenjang_pendidikan', 'title' => 'Jenjang Pendidikan'],
                ['data' => 'nama_program_studi', 'name' => 'nama_program_studi', 'title' => 'Nama Program Studi'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
                'searching' => true,
            ]);
    }
}
