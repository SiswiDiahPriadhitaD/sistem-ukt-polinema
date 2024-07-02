<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\BesaranPajakKendaraanMobilDataTables;
use App\Http\Controllers\Controller;

class BesaranPajakKendaraanMobilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(BesaranPajakKendaraanMobilDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.BesaranPajakKendaraanMobil.index');
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
