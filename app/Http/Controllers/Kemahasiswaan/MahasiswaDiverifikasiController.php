<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\DataTables\Kemahasiswaan\MahasiswaDiverifikasiDataTables;
use App\DataTables\Kemahasiswaan\PeriodeMahasiswaDiverifikasiDataTables;
use App\Http\Controllers\Controller;

class MahasiswaDiverifikasiController extends Controller
{
    public function index(PeriodeMahasiswaDiverifikasiDataTables $dataTable)
    {
        return $dataTable->render('Kemahasiswaan.mahasiswa-diverifikasi.index');
    }

    public function showMahasiswaDiverifikasi($periode_id)
    {
        $dataTable = new MahasiswaDiverifikasiDataTables($periode_id);
        return $dataTable->render('Kemahasiswaan.mahasiswa-diverifikasi.table-diverifikasi');
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