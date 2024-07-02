<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->editColumn('created_at', function ($user) {
                setlocale(LC_TIME, 'id_ID.utf8');
                return Carbon::parse($user->created_at)->locale('id')->isoFormat('D MMMM YYYY HH:mm');
            })
            ->addColumn('status', function ($user) {
                return is_null($user->deleted_at) ? 'Aktif' : 'Tidak Aktif';
            })
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#editUserModal">Ubah</a>';
                if (is_null($row->deleted_at)) {
                    $deleteBtn = '<button onclick="confirmDeactivate(' . $row->id . ')" class="btn btn-danger btn-sm">Non-Aktifkan</button>';
                } else {
                    $deleteBtn = '<button onclick="confirmRestore(' . $row->id . ')" class="btn btn-success btn-sm">Aktifkan</button>';
                }
                return '<div class="text-center">' . $editBtn . $deleteBtn . '</div>';
            })
            ->rawColumns(['action', 'created_at', 'status']);
    }

    public function query(User $model)
    {
        return $model->newQuery()
            ->withTrashed()
            ->select('id', 'name', 'username', 'created_at', 'deleted_at', 'email_verified_at'); // Mengubah 'email' menjadi 'username'
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'username', 'name' => 'username', 'title' => 'Username'], // Mengubah 'Email' menjadi 'Username'
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'status', 'name' => 'status', 'title' => 'Status', 'orderable' => false, 'searchable' => false],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
            ]);
    }
}
