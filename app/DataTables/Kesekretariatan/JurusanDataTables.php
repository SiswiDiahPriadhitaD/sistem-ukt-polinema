<?php

namespace App\DataTables\Kesekretariatan;

use App\Models\Jurusan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class JurusanDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<button onclick="editJurusan(' . $row->id . ')" class="edit btn btn-primary btn-sm mr-1">Ubah</button>';
                $deleteBtn = '<button onclick="confirmDelete(' . $row->id . ')" class="btn btn-danger btn-sm">Hapus</button>';
                return '<div class="text-center">' . $editBtn . $deleteBtn . '</div>';
            });
    }

    public function query(Jurusan $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'nama_jurusan', 'name' => 'nama_jurusan', 'title' => 'Nama Jurusan'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
                'searching' => true,
            ]);
    }
}
