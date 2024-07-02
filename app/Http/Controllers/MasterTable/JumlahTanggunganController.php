<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\JumlahTanggunganDataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JumlahTanggunganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(JumlahTanggunganDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.JumlahTanggungan.index');
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
