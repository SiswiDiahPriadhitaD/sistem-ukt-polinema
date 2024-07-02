@extends('landing-page.app')
@section('title', 'UKT POLINEMA')
@push('style')
    <link rel="stylesheet" href="/assets/css/dashboard.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto mt-4 w-alert">
    </div>
    <div class="col-md-11 d-flex mx-auto info mb-4">
        <span class="s-info py-2 px-3">UPDATE INFO</span>
        @if (!$periode)
            <marquee class="m-desc py-2">
                <span class="font-weight-bold"> |</span> Pendaftaran Pengajuan Keringanan UKT Politeknik
                Negeri Malang <span class="font-weight-bold"> BELUM DIBUKA</span> |
            </marquee>
        @else
            <marquee class="m-desc py-2">
                <span class="font-weight-bold"> |</span> Pendaftaran Pengajuan Keringanan UKT Politeknik
                Negeri Malang <span class="font-weight-bold"> Telah DIBUKA</span> |
            </marquee>
        @endif

    </div>
    <div class="d-flex col-md-11 mx-auto text-justify c-main">
        <div class="col-md-8 p-0 c-summary">
            <p class="p-main-title mb-0 py-1 px-3">TINJAUAN SINGKAT</p>
            <p class="p-main pt-2 pb-4 px-3">
                <img class="img-fluid img-h p-1 mr-3 grayscale"
                    style="width: 20%; height: 20%; object-fit: contain; float: left;"
                    src="{{ asset('assets/img/logo.png') }}">
                <span>
                    Politeknik Negeri Malang (POLINEMA) merupakan Perguruan Tinggi Vokasi Negeri yang terakreditasi A.
                    Pendidikan Vokasi adalah pendidikan tinggi Program Diploma yang menyiapkan mahasiswa untuk pekerjaan
                    dengan keahlian terapan tertentu. POLINEMA menyelenggarakan pendidikan vokasi Program Diploma III,
                    Diploma IV dan Program Magister Terapan. POLINEMA didirikan sejak tahun 1982 dengan nama Program
                    Pendidikan Diploma Bidang Teknik, Fakultas Non Gelar Teknologi, Universitas Brawijaya dan pada tahun
                    2004 memperoleh status kemandirian menjadi Politeknik Negeri Malang. Proses pembelajaran di POLINEMA
                    berorientasi untuk mengembangkan hard skill dan soft skill mahasiswa. Pengembangan hard skill mahasiswa
                    dilakukan dengan konsep “learning by doing”, yang menyajikan 40 persen teori dan 60 persen praktik.
                    Proses pembelajaran juga ditujukan untuk mengembangkan karakter mahasiswa seperti kejujuran,
                    kepemimpinan, disiplin, kerja tim dan kemampuan untuk bekerja cerdas. <br>
                    POLINEMA memiliki 7 jurusan dengan 46 Program Studi pada jenjang pendidikan D-III, D-IV dan Magister
                    Terapan (S2). Kampus Utama memiliki 13 Program Studi D-III, 15 Program Studi D-IV, dan 3 Program Studi
                    Magister Terapan (S2). Untuk Program Studi di Luar Kampus Utama (PSDKU) terdiri dari 3 Program Studi
                    D-III dan 3 Program Studi D-IV di PSDKU Kediri, 3 Program Studi D-III dan 1 Program Studi D-IV di PSDKU
                    Lumajang, serta 1 Program Studi D-III dan 2 Program Studi D-IV di PSDKU Pamekasan. POLINEMA juga
                    memiliki Program Kelas Internasional dan Program Double Degree yang bekerjasama dengan perguruan tinggi
                    terkemuka di China dan Malaysia yaitu Management and Science University (MSU) Malaysia, Shenyang Jianzu
                    University (SJU) China, Shandong University of Science and Technology (SDUST) China, Shenyang Aerospace
                    University (SAU) China.
                </span>
            </p>
        </div>
        <div class="col-md-4 pr-0 c-submain">
            <p class="p-sub-title mb-0 py-1 px-3 text-center">INFORMASI</p>
            <div class="list-berkas">
                <div class="d-flex p-sub py-3 px-3 my-2">
                    @if (!$periode)
                        <div class="d-flex mx-auto">

                            <i class="far fa-file-excel i-not mr-3"></i>
                            <p class="my-auto p-0 p-not">!! Belum Tersedia Informasi !!</p>
                            <i class="far fa-file-excel i-not ml-3"></i>
                        </div>
                    @else
                        <div class="d-flex mx-auto">
                            <p class="my-auto p-0 p-not">Periode Dibuka Mulai Tanggal
                                {{ $periode->tanggal_mulai_periode }}
                                - {{ $periode->tanggal_akhir_periode }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    @push('customScript')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $("#success-alert").fadeOut('slow');
                }, 5000);
            });
            $(document).ready(function() {
                setTimeout(function() {
                    $("#warning-alert").fadeOut('slow');
                }, 5000);
            });
        </script>
    @endpush
