<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RoleDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#editRoleModal">Ubah</a>';
                $deleteBtn = '<button onclick="confirmDelete(' . $row->id . ')" class="btn btn-danger btn-sm">Hapus</button>';
                return '<div class="text-center">' . $editBtn . $deleteBtn . '</div>';
            })
            ->rawColumns(['action', 'created_at', 'status']);
    }

    public function query(Role $model)
    {
        return $model->newQuery()
            ->select('id', 'name');
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
            ]);
    }
}
