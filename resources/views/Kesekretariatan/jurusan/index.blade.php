@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Jurusan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#createJurusanModal">Tambah
                                    Jurusan</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered jurusan-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jurusan</th>
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
    @include('Kesekretariatan.jurusan.modal-create')
    @include('Kesekretariatan.jurusan.modal-edit')
@endsection

@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.jurusan-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jurusan.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_jurusan',
                        name: 'nama_jurusan'
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

            $('#createJurusanModal, #editJurusanModal').on('hidden.bs.modal', function() {
                $(this).find('.text-danger').text('');
                $(this).find('.form-control').removeClass('is-invalid');
            });

            $('#createJurusanForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('jurusan.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#createJurusanModal').modal('hide');
                            $('#createJurusanForm')[0].reset();
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

            window.editJurusan = function(id) {
                $.ajax({
                    url: "{{ route('jurusan.show', ':id') }}".replace(':id', id),
                    method: "GET",
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        $('#edit_nama_jurusan').val(data.nama_jurusan);
                        $('#editJurusanModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Unable to fetch data. Please try again later.',
                            'error');
                    }
                });
            };

            $('#editJurusanForm').on('submit', function(event) {
                event.preventDefault();
                var id = $('#edit_id').val();
                $.ajax({
                    url: "{{ route('jurusan.update', ':id') }}".replace(':id', id),
                    method: "PUT",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#editJurusanModal').modal('hide');
                            $('#editJurusanForm')[0].reset();
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
                if (errors.nama_jurusan) {
                    $('#' + formType + '_nama_jurusan').addClass('is-invalid');
                    $('#' + formType + '_nama_jurusan_error').text(errors.nama_jurusan[0]);
                }
            }

            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Menghapus Jurusan',
                    text: "Mau menghapus Jurusan ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('jurusan.destroy', ['jurusan' => ':id']) }}'
                                .replace(
                                    ':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire('Jurusan Dihapus!', data.message,
                                        'success');
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
