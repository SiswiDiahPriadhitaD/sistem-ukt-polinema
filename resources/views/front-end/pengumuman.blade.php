@extends('landing-page.app')
@section('title', 'UKT POLINEMA')
@push('style')
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <style>
        .badge-custom {
            font-size: 1.5rem;
            /* Adjust the font size as needed */
            padding: 10px;
        }

        .description {
            font-size: 1.2rem;
            /* Adjust the font size as needed */
            margin-top: 10px;
        }
    </style>
@endpush
@section('main')
    <div class="col-md-11 mx-auto mt-4 w-alert">
    </div>
    <div class="col-md-11 d-flex mx-auto info mb-4">
        <span class="s-info py-2 px-3">UPDATE INFO</span>
        <marquee class="m-desc py-2">
            <span class="font-weight-bold"> |</span> Pendaftaran Pengajuan Keringanan UKT Politeknik
            Negeri Malang <span class="font-weight-bold"> Telah DIBUKA</span>
        </marquee>
    </div>
    <div class="d-flex col-md-11 mx-auto text-justify c-main">
        <div class="col-md-12 p-0 c-summary">
            <p class="p-main-title mb-0 py-1 px-3">Hasil Pengajuan UKT</p>
            <p class="p-main pt-2 pb-4 px-3">
                <span>
                    @if (
                        $mahasiswa->status_verifikasi === 'Proses Diverifikasi' ||
                            ($mahasiswa->status_verifikasi === 'Diverifikasi' && $mahasiswa->status_verifikasi_perhitungan === 'Pending'))
                        <span class="badge badge-warning badge-custom">Proses Pengajuan UKT sedang di proses</span>
                        <br>
                        <br>
                        <span class="description">Selamat, pengajuan UKT Anda sedang diproses. Harap menunggu informasi
                            lebih
                            lanjut.
                        </span>
                    @elseif ($mahasiswa->status_verifikasi === 'Ditolak')
                        <span class="badge badge-danger badge-custom">Status Pengajuan Keringanan UKT DITOLAK</span>
                        <br>
                        <br>
                        <span class="description">Maaf, pengajuan keringanan UKT Anda ditolak. Silakan hubungi administrasi
                            untuk informasi lebih lanjut.</span>
                        {{-- @endif --}}
                    @elseif ($mahasiswa->status_verifikasi_perhitungan === 'Diverifikasi' && $mahasiswa->status_verifikasi === 'Diverifikasi')
                        @if ($mahasiswa->status_verifikasi !== 'Ditolak')
                            <span class="badge badge-success badge-custom">Pengajuan Kelompok UKT DITERIMA</span>
                            <br>
                            <br>
                            <span class="description">Selamat, pengajuan keringanan UKT Anda telah diverifikasi. Anda
                                sekarang
                                berada di kelompok UKT baru:
                            </span>
                            <br>
                            <span class="description">
                                Kelompok {{ $mahasiswa->kelompokUktBaru->nama_kelompok_ukt }} dengan nominal yang harus
                                dibayarkan Rp. {{ $mahasiswa->kelompokUktBaru->nominal_kelompok_ukt }}.
                            </span>
                        @endif
                    @elseif ($mahasiswa->status_verifikasi_perhitungan === 'Ditolak')
                        <span class="badge badge-success badge-custom">Pengajuan Kelompok UKT DITERIMA</span>
                        <br>
                        <br>
                        <span class="description">Selamat, pengajuan keringanan UKT Anda telah diverifikasi. Anda
                            sekarang
                            berada di kelompok UKT baru:
                        </span>
                        <br>
                        <span class="description">
                            Kelompok {{ $mahasiswa->kelompokUktBaru->nama_kelompok_ukt }} dengan nominal yang harus
                            dibayarkan Rp. {{ $mahasiswa->kelompokUktBaru->nominal_kelompok_ukt }}.
                        </span>
                    @endif
                </span>
            </p>
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
