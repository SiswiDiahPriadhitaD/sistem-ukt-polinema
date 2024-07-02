@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Periode</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#createPeriodeModal">Tambah
                                    Periode</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered periode-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Periode</th>
                                            <th>Status Periode</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th class="text-center">Aksi</th>
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
    @include('Kesekretariatan.periode.modal-create')
    @include('Kesekretariatan.periode.modal-edit')
@endsection

@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.periode-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('periode.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_periode',
                        name: 'nama_periode'
                    },
                    {
                        data: 'status_periode',
                        name: 'status_periode',
                        searchable: true
                    },
                    {
                        data: 'tanggal_mulai_periode',
                        name: 'tanggal_mulai_periode'
                    },
                    {
                        data: 'tanggal_akhir_periode',
                        name: 'tanggal_akhir_periode'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'></i>",
                        next: "<i class='fas fa-angle-right'></i>"
                    }
                }
            });

            $('.select2').select2({
                width: '100%',
                placeholder: "Pilih Status Periode"
            });

            $('#createPeriodeModal, #editPeriodeModal').on('hidden.bs.modal', function() {
                $(this).find('.text-danger').text('');
                $(this).find('.form-control').removeClass('is-invalid');
            });

            $('#createPeriodeForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('periode.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#createPeriodeModal').modal('hide');
                            $('#createPeriodeForm')[0].reset();
                            table.ajax.reload();
                            Swal.fire('Success!', data.success, 'success');
                        }
                    },
                    error: function(response) {
                        resetValidationErrors();
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            if (response.responseJSON.error) {
                                Swal.fire('Error!', response.responseJSON.error, 'error');
                            }
                            setValidationErrors(errors, 'create');
                        } else {
                            Swal.fire('Error!', 'Something went wrong. Please try again later.',
                                'error');
                        }
                    }
                });
            });

            window.editPeriode = function(id) {
                $.ajax({
                    url: "{{ route('periode.show', ':id') }}".replace(':id', id),
                    method: "GET",
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        $('#edit_nama_periode').val(data.nama_periode);
                        $('#edit_status_periode').val(data.status_periode).trigger('change');
                        $('#edit_tanggal_mulai_periode').val(data.tanggal_mulai_periode);
                        $('#edit_tanggal_akhir_periode').val(data.tanggal_akhir_periode);
                        $('#editPeriodeModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Unable to fetch data. Please try again later.',
                            'error');
                    }
                });
            };

            $('#editPeriodeForm').on('submit', function(event) {
                event.preventDefault();
                var id = $('#edit_id').val();
                $.ajax({
                    url: "{{ route('periode.update', ':id') }}".replace(':id', id),
                    method: "PUT",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#editPeriodeModal').modal('hide');
                            $('#editPeriodeForm')[0].reset();
                            table.ajax.reload();
                            Swal.fire('Success!', data.success, 'success');
                        }
                    },
                    error: function(response) {
                        resetValidationErrors();
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            if (response.responseJSON.error) {
                                Swal.fire('Error!', response.responseJSON.error, 'error');
                            }
                            setValidationErrors(errors, 'edit');
                        } else {
                            Swal.fire('Error!', 'Something went wrong. Please try again later.',
                                'error');
                        }
                    }
                });
            });

            function resetValidationErrors() {
                $('.text-danger').text('');
                $('.form-control').removeClass('is-invalid');
            }

            function setValidationErrors(errors, formType) {
                if (errors.nama_periode) {
                    $('#' + formType + '_nama_periode').addClass('is-invalid');
                    $('#' + formType + '_nama_periode_error').text(errors.nama_periode[0]);
                }
                if (errors.status_periode) {
                    $('#' + formType + '_status_periode').addClass('is-invalid');
                    $('#' + formType + '_status_periode_error').text(errors.status_periode[0]);
                }
                if (errors.tanggal_mulai_periode) {
                    $('#' + formType + '_tanggal_mulai_periode').addClass('is-invalid');
                    $('#' + formType + '_tanggal_mulai_periode_error').text(errors.tanggal_mulai_periode[0]);
                }
                if (errors.tanggal_akhir_periode) {
                    $('#' + formType + '_tanggal_akhir_periode').addClass('is-invalid');
                    $('#' + formType + '_tanggal_akhir_periode_error').text(errors.tanggal_akhir_periode[0]);
                }
            }

            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Menghapus Periode',
                    text: "Mau menghapus periode ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('periode.destroy', ['periode' => ':id']) }}'.replace(
                                ':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire('Periode Dihapus!', data.message, 'success');
                                    table.ajax.reload();
                                } else {
                                    Swal.fire('Error!', data.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!',
                                    'Error, Permintaan tidak dapat di proses.', 'error');
                            }
                        });
                    }
                });
            };
        });
    </script>
    @if (Session::has('success'))
        <script>
            iziToast.success({
                title: 'Success',
                message: '{{ Session::get('success') }}',
                position: 'topRight'
            });
        </script>
    @elseif (Session::has('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('error') }}',
                position: 'topRight'
            });
        </script>
    @endif
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
