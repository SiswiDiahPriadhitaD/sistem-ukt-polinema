<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\JumlahAnakDataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JumlahAnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(JumlahAnakDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.JumlahAnak.index');
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
