<?php

namespace App\DataTables;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AssignRoleDataTables extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<a href="' . route('assign.user.edit', ['user' => $row->id]) . '" class="edit btn btn-primary btn-sm mr-1">Ubah</a>';
                return '<div class="text-center">' . $editBtn . '</div>';
            });
    }

    public function query(User $model)
    {
        return $model->newQuery()
            ->with('roles');
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'No.', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'username', 'name' => 'username', 'title' => 'Username'], // Mengubah 'Email' menjadi 'Username'
                ['data' => 'roles', 'name' => 'roles.name', 'title' => 'Roles'],
                ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
            ])
            ->parameters([
                'dom' => 'Bfrtip',
                'order' => [[1, 'asc']],
            ]);
    }
}
