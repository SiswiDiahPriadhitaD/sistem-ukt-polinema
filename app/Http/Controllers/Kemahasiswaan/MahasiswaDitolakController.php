<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\DataTables\Kemahasiswaan\MahasiswaDitolakDataTables;
use App\DataTables\Kemahasiswaan\PeriodeMahasiswaDitolakDataTables;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Periode;
use Illuminate\Http\Request;

class MahasiswaDitolakController extends Controller
{
    public function index(PeriodeMahasiswaDitolakDataTables $dataTable)
    {
        return $dataTable->render('Kemahasiswaan.mahasiswa-ditolak.index');
    }

    public function showMahasiswaDitolak($periode_id)
    {
        $dataTable = new MahasiswaDitolakDataTables($periode_id);
        return $dataTable->render('Kemahasiswaan.mahasiswa-ditolak.table-ditolak');
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
