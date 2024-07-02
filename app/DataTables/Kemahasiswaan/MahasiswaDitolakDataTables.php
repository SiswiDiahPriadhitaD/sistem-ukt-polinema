<?php

namespace App\DataTables\Kemahasiswaan;

use App\Models\Mahasiswa;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MahasiswaDitolakDataTables extends DataTable
{
    protected $periode_id;
    public function __construct($periode_id)
    {
        $this->periode_id = $periode_id;
    }

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<button onclick="editMahasiswa(' . $row->id . ')" class="edit btn btn-primary btn-sm mr-1">Ubah</button>';
                $deleteBtn = '<button onclick="confirmDelete(' . $row->id . ')" class="btn btn-danger btn-sm mr-1">Hapus</button>';
                $statusBtn = '<button onclick="showStatusModal(' . $row->id . ')" class="btn btn-warning btn-sm mr-1">Ubah Status</button>';
                return '<div class="text-center">' . $editBtn . $deleteBtn . $statusBtn . '</div>';
            })
            ->addColumn('details', function ($row) {
                return '<button class="btn btn-info btn-sm" data-id="' . $row->id . '"><i class="fas fa-chevron-down"></i></button>';
            })
            ->editColumn('program_studi', function ($row) {
                return $row->jenjang_pendidikan . ' ' . $row->nama_program_studi;
            })
            ->editColumn('jurusan', function ($row) {
                return $row->nama_jurusan;
            })
            ->editColumn('id_periode', function ($row) {
                return $row->nama_periode;
            })
            ->addColumn('status_verifikasi', function ($row) {
                $color = '';
                if ($row->status_verifikasi === 'Diverifikasi') {
                    $color = 'green';
                } elseif ($row->status_verifikasi === 'Proses Diverifikasi') {
                    $color = 'grey';
                } elseif ($row->status_verifikasi === 'Ditolak') {
                    $color = 'red';
                }
                return '<span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background-color: ' . $color . '; margin-right: 5px;"></span>' . $row->status_verifikasi;
            })
            ->rawColumns(['status_verifikasi', 'action', 'details']);
    }

    public function query(Mahasiswa $model)
    {
        \Log::info('Periode ID: ' . $this->periode_id);

        return $model->newQuery()
            ->leftJoin('program_studi', 'mahasiswa.id_program_studi', '=', 'program_studi.id')
            ->leftJoin('jurusan', 'program_studi.id_jurusan', '=', 'jurusan.id')
            ->leftJoin('periode', 'mahasiswa.id_periode', '=', 'periode.id')
            ->select([
                'mahasiswa.*',
                'program_studi.nama_program_studi',
                'program_studi.jenjang_pendidikan',
                'jurusan.nama_jurusan',
                'periode.nama_periode'
            ])
            ->where('status_verifikasi', 'Ditolak')
            ->where('mahasiswa.id_periode', $this->periode_id);
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'nama_mahasiswa', 'name' => 'nama_mahasiswa', 'title' => 'Nama Mahasiswa'],
                ['data' => 'semester_mahasiswa', 'name' => 'semester_mahasiswa', 'title' => 'Semester Mahasiswa'],
                ['data' => 'nim_mahasiswa', 'name' => 'nim_mahasiswa', 'title' => 'NIM Mahasiswa'],
                ['data' => 'jurusan', 'name' => 'jurusan', 'title' => 'Jurusan'],
                ['data' => 'program_studi', 'name' => 'program_studi', 'title' => 'Program Studi'],
                ['data' => 'id_periode', 'name' => 'id_periode', 'title' => 'Periode'],
                ['data' => 'histori_pengajuan_mahasiswa', 'name' => 'histori_pengajuan_mahasiswa', 'title' => 'Keterangan'],
                ['data' => 'status_verifikasi', 'name' => 'status_verifikasi', 'title' => 'Status Verifikasi'],
                ['data' => 'details', 'name' => 'details', 'title' => 'Details', 'orderable' => false, 'searchable' => false],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
                'searching' => true,
            ]);
    }
}
