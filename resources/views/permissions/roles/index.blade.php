@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Role</h1>
        </div>
        <div class="section-body">
            <div class="row">
                @include('layouts.alert')
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button class="btn btn-icon icon-left btn-primary" data-toggle="modal"
                                    data-target="#createRoleModal">Tambah Role</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered role-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Role</th>
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
    @include('permissions.roles.create')
    @include('permissions.roles.edit')
@endsection
@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var table = $('.role-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('role.index') }}",
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
                var fieldSelector = '#' + formType + 'RoleModal #' + fieldName;
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
                var fieldSelector = '#' + formType + 'RoleModal #' + fieldName;
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

            $('#createRoleForm input').on('input', function() {
                var fieldName = $(this).attr('name');
                var value = $(this).val();
                validateField(fieldName, value, '{{ route('validate-create-role') }}', 'create');
            });

            $('.role-data-table').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.get('{{ route('role.show', '') }}/' + id, function(data) {
                    $('#editRoleModal input[name="name"]').val(data.name);
                    $('#editRoleModal input[name="id"]').val(data.id);
                    resetValidationStates('edit');
                });
                $('#editRoleModal').modal('show');
            });

            $('#editRoleModal input').on('input', function() {
                var fieldName = $(this).attr('name');
                var value = $(this).val();
                validateField(fieldName, value, '{{ route('validate-update-role') }}', 'edit');
            });

            function resetValidationStates(formType) {
                var formSelector = '#' + formType + 'RoleModal input';
                $(formSelector).removeClass('is-invalid is-valid');
                $(formSelector + 'Error').text('').hide();
            }

            function handleSubmit(formSelector, fieldValidations, url, successMessage, errorMessage, isEdit =
                false) {
                $(formSelector).on('submit', function(e) {
                    e.preventDefault();
                    if (Object.values(fieldValidations).every(value => value === true)) {
                        var formData = $(this).serialize();
                        var method = isEdit ? 'PUT' : 'POST';
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    iziToast.success({
                                        title: 'Success',
                                        message: successMessage,
                                        position: 'topRight'
                                    });
                                    $(formSelector)[0].reset();
                                    $(formSelector + ' .is-valid, ' + formSelector +
                                            ' .is-invalid')
                                        .removeClass('is-valid is-invalid');
                                    $(formSelector).closest('.modal').modal('hide');
                                    $('.role-data-table').DataTable().ajax.reload();
                                } else if (response.error) {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Role telah ada',
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
            var baseUrl = '{{ route('role.update', ['role' => ':id']) }}';
            var roleId = $('#editRoleForm input[name="id"]').val();
            var updateUrl = baseUrl.replace(':id', roleId);
            handleSubmit('#createRoleForm', createFieldValidations, '{{ route('role.store') }}',
                'Role Berhasil Ditambahkan.', 'Tolong Cek dan Coba Lagi.');
            handleSubmit('#editRoleForm', editFieldValidations, updateUrl, 'Role Berhasil Diubah.',
                'Tolong Cek dan Coba Lagi.', true);

        });
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Menghapus Role',
                text: "Mau menghapus role ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('role.destroy', '') }}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire('Role Dihapus!', data.message, 'success');
                                $('.role-data-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Error , Permintaan tidak dapat di proses.',
                                'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush

@push('customStyle')
@endpush
