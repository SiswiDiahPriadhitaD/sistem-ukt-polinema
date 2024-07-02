@if (!$periodeAktif)
    <div class="alert alert-danger">
        <p class="m-0 p-0 p-alert">
            ~ Pendaftaran Belum Dibuka ~
        </p>
    </div>
@elseif ($periodeAktif && $biodata == null)
    <div class="alert alert-success">
        <p class="m-0 p-0 p-alert">"Sudah Dibuka Pendaftaran"</p>
        <hr class="my-2">
        <hr class="m-0">
    </div>
@elseif ($periodeAktif && $biodata->status_verifikasi == 'Proses Diverifikasi')
    <div class="alert alert-success">
        <p class="m-0 p-0 p-alert">"Sudah Dibuka Pendaftaran"</p>
        <hr class="my-2">
        <hr class="m-0">
    </div>
@elseif ($biodata->status_verifikasi == 'Ditolak' && $periodeAktif->id == $biodata->id_periode)
    <div class="alert alert-danger">
        <p class="m-0 p-0 p-alert">"Maaf, Anda Ditolak. Silahkan Daftar Periode Depan"</p>
        <hr class="my-2">
        <hr class="m-0">
    </div>
@elseif ($periodeAktif->id != $biodata->id_periode)
    <div class="alert alert-info">
        <p class="m-0 p-0 p-alert">"Anda dapat mengajukan keringan UKT kembali."</p>
        <hr class="my-2">
        <hr class="m-0">
    </div>
@endif
