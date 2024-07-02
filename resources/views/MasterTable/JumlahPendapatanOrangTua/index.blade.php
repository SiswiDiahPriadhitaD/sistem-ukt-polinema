@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Jumlah Pendapatan Orang Tua</h1>
        </div>
        <div class="section-body">
            <div class="row">
                @include('layouts.alert')
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered jumlah-pendapatan-orang-tua-data-table"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kriteria</th>
                                            <th>Nilai Kriteria</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var table = $('.jumlah-pendapatan-orang-tua-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jumlah-pendapatan-orang-tua.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_kriteria',
                        name: 'nama_kriteria',
                        orderable: false,
                    },
                    {
                        data: 'nilai_kriteria',
                        name: 'nilai_kriteria'
                    },
                ],
                order: [
                    [2, 'asc']
                ],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'></i>",
                        next: "<i class='fas fa-angle-right'></i>"
                    }
                }
            });
        });
    </script>
@endpush

@push('customStyle')
@endpush
