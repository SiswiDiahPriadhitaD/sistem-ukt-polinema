<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\StatusOrangTuaDataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatusOrangTuaRequest;
use App\Http\Requests\UpdateStatusOrangTuaRequest;
use App\Models\StatusOrangTua;

class StatusOrangTuaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }


    public function index(StatusOrangTuaDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.StatusOrangTua.index');
    }

    public function create()
    {
        //Tidak Dipakai
    }

    public function store()
    {
        //Tidak Dipakai
    }

    public function show()
    {
        //Tidak Dipakai
    }


    public function edit()
    {
        //Tidak Dipakai
    }

    public function update()
    {
        //Tidak Dipakai
    }

    public function destroy()
    {
        //Tidak Dipakai
    }
}
