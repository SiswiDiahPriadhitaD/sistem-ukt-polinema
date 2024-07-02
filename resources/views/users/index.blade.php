@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List User</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button class="btn btn-icon icon-left btn-primary" data-toggle="modal"
                                    data-target="#createUserModal">Tambah User</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered user-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Usernmae</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Status Akun</th>
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
    @include('users.create')
    @include('users.edit')
@endsection
@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var table = $('.user-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'></i>",
                        next: "<i class='fas fa-angle-right'></i>"
                    }
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var createFieldValidations = {};
            var editFieldValidations = {};

            function handleSuccess(response, fieldName, formType) {
                var fieldSelector = '#' + formType + 'UserModal #' + fieldName;
                if (response.success) {
                    $(fieldSelector).removeClass('is-invalid').addClass('is-valid');
                    $(fieldSelector + 'Error').text('').hide();
                    if (formType === 'create') {
                        createFieldValidations[fieldName] = true;
                    } else {
                        editFieldValidations[fieldName] = true;
                    }
                } else {
                    displayErrors(fieldName, response.errors, formType);
                }
            }

            function displayErrors(fieldName, errors, formType) {
                var fieldSelector = '#' + formType + 'UserModal #' + fieldName;
                console.log(errors);
                if (errors[fieldName]) {
                    $(fieldSelector).addClass('is-invalid').removeClass('is-valid');
                    $(fieldSelector + 'Error').text(errors[fieldName][0]).show();
                    if (formType === 'create') {
                        createFieldValidations[fieldName] = false;
                    } else {
                        editFieldValidations[fieldName] = false;
                    }
                } else {
                    $(fieldSelector).removeClass('is-invalid').addClass('is-valid');
                    $(fieldSelector + 'Error').text('').hide();
                    if (formType === 'create') {
                        createFieldValidations[fieldName] = true;
                    } else {
                        editFieldValidations[fieldName] = true;
                    }
                }
            }

            function validateField(fieldName, value, url, formType) {
                var data = {};
                data[fieldName] = value;
                data['_token'] = $('input[name="_token"]').val();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        handleSuccess(response, fieldName, formType);
                    },
                    error: function(xhr) {
                        var errorResponse = JSON.parse(xhr.responseText);
                        displayErrors(fieldName, errorResponse.errors, formType);
                    }
                });
            }

            $('#createUserForm input').on('input', function() {
                var fieldName = $(this).attr('name');
                var value = $(this).val();
                validateField(fieldName, value, '{{ route('validate-create-user') }}', 'create');
            });

            $('.user-data-table').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.get('{{ route('user.show', '') }}/' + id, function(data) {
                    $('#editUserModal input[name="name"]').val(data.name);
                    $('#editUserModal input[name="username"]').val(data.username);
                    $('#editUserModal input[name="id"]').val(data.id);
                    resetValidationStates('edit');
                });
                $('#editUserModal').modal('show');
            });

            $('#editUserModal input').on('input', function() {
                var fieldName = $(this).attr('name');
                var value = $(this).val();
                validateField(fieldName, value, '{{ route('validate-update-user') }}', 'edit');
            });

            function resetValidationStates(formType) {
                var formSelector = '#' + formType + 'UserModal input';
                $(formSelector).removeClass('is-invalid is-valid');
                $(formSelector + 'Error').text('').hide();
            }

            function handleSubmit(formSelector, fieldValidations, url, successMessage, errorMessage, isEdit =
            false) {
                $(formSelector).on('submit', function(e) {
                    e.preventDefault();
                    if (Object.values(fieldValidations).every(value => value === true)) {
                        var formData = $(this).serialize();
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                if (response.success) {
                                    iziToast.success({
                                        title: 'Success',
                                        message: successMessage,
                                        position: 'topRight'
                                    });
                                    $(formSelector)[0].reset();
                                    $(formSelector + ' .is-valid, ' + formSelector +
                                        ' .is-invalid').removeClass('is-valid is-invalid');
                                    $(formSelector).closest('.modal').modal('hide');
                                    $('.user-data-table').DataTable().ajax.reload();
                                } else if (response.error) {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Username already exists', // Mengubah pesan dari 'Email' menjadi 'Username'
                                        position: 'topRight'
                                    });
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: response.message,
                                    });
                                }
                            },
                            error: function(xhr) {
                                var errorResponse = JSON.parse(xhr.responseText);
                                iziToast.error({
                                    title: 'Error',
                                    message: errorResponse.message,
                                    position: 'topRight'
                                });
                            }
                        });
                    } else {
                        iziToast.error({
                            title: 'Validation',
                            message: errorMessage,
                            position: 'topRight'
                        });
                    }
                });
            }
            var baseUrl = '{{ route('user.update') }}';
            var userId = $('#editUserForm input[name="id"]').val();
            var updateUrl = baseUrl;
            handleSubmit('#createUserForm', createFieldValidations, '{{ route('user.store') }}',
                'User Berhasil Ditambahkan.', 'Tolong Cek dan Coba Lagi.');
            handleSubmit('#editUserForm', editFieldValidations, updateUrl, 'User Berhasil Diubah.',
                'Tolong Cek dan Coba Lagi.', true);

        });
    </script>

    <script>
        function confirmDeactivate(id) {
            Swal.fire({
                title: 'Nonaktifkan User',
                text: "Mau menonaktifkan user ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('{{ route('user.deactivate', '') }}/' + id, {
                        _token: '{{ csrf_token() }}'
                    }, function(data) {
                        Swal.fire('Deactivated!', data.message, 'success');
                        $('.user-data-table').DataTable().ajax.reload();
                    });
                }
            });
        }

        function confirmRestore(id) {
            Swal.fire({
                title: 'Aktifkan User',
                text: "Mau mengaktifkan user ini?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('{{ route('user.restore', '') }}/' + id, {
                        _token: '{{ csrf_token() }}'
                    }, function(data) {
                        Swal.fire('Restored!', data.message, 'success');
                        $('.user-data-table').DataTable().ajax.reload();
                    });
                }
            });
        }
    </script>
@endpush

@push('customStyle')
@endpush
