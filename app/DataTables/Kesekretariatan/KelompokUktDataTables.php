<?php

namespace App\DataTables\Kesekretariatan;

use App\Models\KelompokUkt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class KelompokUktDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->filterColumn('nama_program_studi', function ($query, $keyword) {
                $sql = 'CONCAT(program_studi.jenjang_pendidikan, " ", program_studi.nama_program_studi) like ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($row) {
                $editBtn = '<button onclick="editKelompokUkt(' . $row->id . ')" class="edit btn btn-primary btn-sm mr-1">Ubah</button>';
                $deleteBtn = '<button onclick="confirmDelete(' . $row->id . ')" class="btn btn-danger btn-sm">Hapus</button>';
                return '<div class="text-center">' . $editBtn . $deleteBtn . '</div>';
            });
    }

    public function query(KelompokUkt $model)
    {
        return $model->newQuery()->select(
            'kelompok_ukt.id',
            'kelompok_ukt.nama_kelompok_ukt',
            'kelompok_ukt.nominal_kelompok_ukt',
            'kelompok_ukt.id_program_studi',
            DB::raw('CONCAT(program_studi.jenjang_pendidikan, " ", program_studi.nama_program_studi) as nama_program_studi')
        )->leftJoin('program_studi', 'kelompok_ukt.id_program_studi', '=', 'program_studi.id');
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'nama_program_studi', 'name' => 'nama_program_studi', 'title' => 'Program Studi', 'searchable' => true],
                ['data' => 'nama_kelompok_ukt', 'name' => 'kelompok_ukt.nama_kelompok_ukt', 'title' => 'Nama Kelompok Ukt'],
                ['data' => 'nominal_kelompok_ukt', 'name' => 'kelompok_ukt.nominal_kelompok_ukt', 'title' => 'Nominal Kelompok Ukt', 'searchable' => true],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
                'searching' => true,
            ]);
    }
}