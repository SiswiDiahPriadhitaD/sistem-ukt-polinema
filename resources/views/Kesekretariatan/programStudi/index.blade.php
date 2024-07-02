@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Program Studi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#createProgramStudiModal">Tambah
                                    Program Studi</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered program-studi-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jurusan</th>
                                            <th>Jenjang Pendidikan</th>
                                            <th>Nama Program Studi</th>
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
    @include('Kesekretariatan.programStudi.modal-create')
    @include('Kesekretariatan.programStudi.modal-edit')
@endsection

@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.program-studi-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('program-studi.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_jurusan',
                        name: 'jurusan.nama_jurusan'
                    },
                    {
                        data: 'jenjang_pendidikan',
                        name: 'program_studi.jenjang_pendidikan'
                    },
                    {
                        data: 'nama_program_studi',
                        name: 'program_studi.nama_program_studi'
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

            $('#createProgramStudiModal, #editProgramStudiModal').on('hidden.bs.modal', function() {
                $(this).find('.text-danger').text('');
                $(this).find('.form-control').removeClass('is-invalid');
            });

            $('#createProgramStudiModal').on('show.bs.modal', function() {
                $.ajax({
                    url: "{{ route('jurusan.list') }}",
                    method: "GET",
                    success: function(data) {
                        var jurusanSelect = $('#id_jurusan');
                        jurusanSelect.empty();
                        jurusanSelect.append('<option value="">Pilih Jurusan</option>');
                        $.each(data, function(key, jurusan) {
                            jurusanSelect.append('<option value="' + jurusan.id + '">' +
                                jurusan.nama_jurusan + '</option>');
                        });
                    },
                    error: function() {
                        Swal.fire('Error!',
                            'Unable to fetch Jurusan data. Please try again later.', 'error'
                        );
                    }
                });
            });

            $('#createProgramStudiForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('program-studi.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#createProgramStudiModal').modal('hide');
                            $('#createProgramStudiForm')[0].reset();
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

            function resetValidationErrors() {
                $('.text-danger').text('');
                $('.form-control').removeClass('is-invalid');
            }

            function setValidationErrors(errors, formType) {
                if (errors.id_jurusan) {
                    $('#' + formType + '_id_jurusan').addClass('is-invalid');
                    $('#' + formType + '_id_jurusan_error').text(errors.id_jurusan[0]);
                }
                if (errors.nama_program_studi) {
                    $('#' + formType + '_nama_program_studi').addClass('is-invalid');
                    $('#' + formType + '_nama_program_studi_error').text(errors.nama_program_studi[0]);
                }
                if (errors.jenjang_pendidikan) {
                    $('#' + formType + '_jenjang_pendidikan').addClass('is-invalid');
                    $('#' + formType + '_jenjang_pendidikan_error').text(errors.jenjang_pendidikan[0]);
                }
            }

            window.editProgramStudi = function(id) {
                $.ajax({
                    url: "{{ route('program-studi.show', ':id') }}".replace(':id', id),
                    method: "GET",
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        $('#edit_id_jurusan').val(data.id_jurusan);
                        $('#edit_nama_program_studi').val(data.nama_program_studi);
                        $('#edit_jenjang_pendidikan').val(data.jenjang_pendidikan).trigger(
                        'change'); // Pastikan trigger change
                        $('#editProgramStudiModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!',
                            'Unable to fetch Program Studi data. Please try again later.',
                            'error');
                    }
                });
            };


            $('#editProgramStudiModal').on('show.bs.modal', function() {
                $.ajax({
                    url: "{{ route('jurusan.list') }}",
                    method: "GET",
                    success: function(data) {
                        var jurusanSelect = $('#edit_id_jurusan');
                        jurusanSelect.empty();
                        $.each(data, function(key, jurusan) {
                            jurusanSelect.append('<option value="' + jurusan.id + '">' +
                                jurusan.nama_jurusan + '</option>');
                        });
                    },
                    error: function() {
                        Swal.fire('Error!',
                            'Unable to fetch Jurusan data. Please try again later.', 'error'
                        );
                    }
                });
            });

            $('#editProgramStudiForm').on('submit', function(event) {
                event.preventDefault();
                var id = $('#edit_id').val();
                $.ajax({
                    url: "{{ route('program-studi.update', ':id') }}".replace(':id', id),
                    method: "PUT",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#editProgramStudiModal').modal('hide');
                            $('#editProgramStudiForm')[0].reset();
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

            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Menghapus Program Studi',
                    text: "Mau menghapus Program Studi ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('program-studi.destroy', ['program_studi' => ':id']) }}'
                                .replace(
                                    ':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire('Program Studi Dihapus!', data.message,
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
