@extends('landing-page.app')
@section('title', 'UKT POLINEMA | Biodata Pendaftar')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    @include('front-end.alert-biodata')
    <div class="col-md-11 mx-auto text-justify my-4">
        <p class="p-main-title mb-0 py-1 px-3">BIODATA PENDAFTAR</p>
        <div class="p-main py-3 px-3">
            <ul class="nav nav-tabs">
                <li class="nav-bio">
                    <a class="nav-link active" aria-current="page" href="{{ route('front-end.biodata') }}">DATA DIRI</a>
                </li>
                <li class="nav-bio">
                    <a class="nav-link" aria-current="page" href="{{ route('front-end.biodata-pendukung') }}">DATA
                        PENDUKUNG</a>
                </li>
            </ul>
            @include('front-end.data-diri')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endsection

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
