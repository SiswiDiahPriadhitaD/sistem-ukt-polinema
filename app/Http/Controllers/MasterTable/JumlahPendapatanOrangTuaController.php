<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\JumlahPendapatanOrangTuaDataTables;
use App\Http\Controllers\Controller;

class JumlahPendapatanOrangTuaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(JumlahPendapatanOrangTuaDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.JumlahPendapatanOrangTua.index');
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
