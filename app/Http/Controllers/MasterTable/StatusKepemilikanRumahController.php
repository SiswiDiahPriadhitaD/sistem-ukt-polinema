<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\StatusKepemilikanRumahDataTables;
use App\Http\Controllers\Controller;

class StatusKepemilikanRumahController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }


    public function index(StatusKepemilikanRumahDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.StatusKepemilikanRumah.index');
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
