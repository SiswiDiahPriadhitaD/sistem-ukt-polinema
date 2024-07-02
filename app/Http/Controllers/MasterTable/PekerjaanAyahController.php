<?php

namespace App\Http\Controllers\MasterTable;

use App\DataTables\MasterTable\PekerjaanAyahDataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePekerjaanAyahRequest;
use App\Http\Requests\UpdatePekerjaanAyahRequest;
use App\Models\PekerjaanAyah;

class PekerjaanAyahController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }


    public function index(PekerjaanAyahDataTables $dataTable)
    {
        return $dataTable->render('MasterTable.PekerjaanAyah.index');
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
