<?php

namespace App\DataTables\Kemahasiswaan;

use App\Models\Periode;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Carbon\Carbon;

class PeriodeMahasiswaDitolakDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->addColumn('status_periode', function ($row) {
                $color = $row->status_periode === 'Aktif' ? 'green' : 'red';
                return '<span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background-color: ' . $color . '; margin-right: 5px;"></span>' . $row->status_periode;
            })
            ->addColumn('tanggal_mulai_periode', function ($row) {
                return Carbon::parse($row->tanggal_mulai_periode)->locale('id')->isoFormat('DD MMMM YYYY HH:mm:ss');
            })
            ->addColumn('tanggal_akhir_periode', function ($row) {
                return Carbon::parse($row->tanggal_akhir_periode)->locale('id')->isoFormat('DD MMMM YYYY HH:mm:ss');
            })
            ->addColumn('action', function ($row) {
                $viewDitolakBtn = '<a href="' . route('mahasiswa.ditolak.table', $row->id) . '" class="btn btn-warning btn-sm mr-1">Lihat Data Ditolak</a>';
                return '<div class="text-center">' . $viewDitolakBtn  . '</div>';
            })
            ->rawColumns(['status_periode', 'action']);
    }

    public function query(Periode $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'nama_periode', 'name' => 'nama_periode', 'title' => 'Nama Periode'],
                ['data' => 'status_periode', 'name' => 'status_periode', 'title' => 'Status Periode', 'searchable' => true],
                ['data' => 'tanggal_mulai_periode', 'name' => 'tanggal_mulai_periode', 'title' => 'Tanggal Mulai Periode'],
                ['data' => 'tanggal_akhir_periode', 'name' => 'tanggal_akhir_periode', 'title' => 'Tanggal Akhir Periode'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
                'searching' => true,
            ]);
    }
}