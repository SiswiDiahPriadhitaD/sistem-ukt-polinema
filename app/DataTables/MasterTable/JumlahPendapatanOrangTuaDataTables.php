<?php

namespace App\DataTables\MasterTable;

use App\Models\JumlahPendapatanOrangTua;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class JumlahPendapatanOrangTuaDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn();
    }


    public function query(JumlahPendapatanOrangTua $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'nama_kriteria', 'name' => 'nama_kriteria', 'title' => 'Nama Kriteria', 'orderable' => false,],
                ['data' => 'nilai_kriteria', 'name' => 'nilai_kriteria', 'title' => 'Nilai Kriteria'],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
            ]);
    }
}
