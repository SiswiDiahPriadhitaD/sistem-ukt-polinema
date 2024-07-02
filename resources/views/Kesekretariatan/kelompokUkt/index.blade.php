@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Kelompok Ukt</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-header-action">
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#createKelompokUktModal">Tambah
                                    Kelompok UKT</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered kelompok-ukt-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Program Studi</th>
                                            <th>Nama Kelompok UKT</th>
                                            <th>Nominal Kelompok UKT</th>
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
    @include('Kesekretariatan.kelompokUkt.modal-create')
    @include('Kesekretariatan.kelompokUkt.modal-edit')
@endsection

@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.kelompok-ukt-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kelompok-ukt.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_program_studi',
                        name: 'nama_program_studi'
                    },
                    {
                        data: 'nama_kelompok_ukt',
                        name: 'kelompok_ukt.nama_kelompok_ukt'
                    },
                    {
                        data: 'nominal_kelompok_ukt',
                        name: 'kelompok_ukt.nominal_kelompok_ukt',
                        searchable: true,
                        render: function(data, type, row) {
                            return 'Rp. ' + parseInt(data).toLocaleString('id-ID');
                        }
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

            $('#createKelompokUktModal, #editKelompokUktModal').on('hidden.bs.modal', function() {
                $(this).find('.text-danger').text('');
                $(this).find('.form-control').removeClass('is-invalid');
            });

            $('#createKelompokUktModal').on('show.bs.modal', function() {
                $.ajax({
                    url: "{{ route('program-studi.list') }}",
                    method: "GET",
                    success: function(data) {
                        var programStudiSelect = $('#id_program_studi');
                        programStudiSelect.empty();
                        programStudiSelect.append(
                            '<option value="">Pilih Program Studi</option>');
                        $.each(data, function(key, programStudi) {
                            programStudiSelect.append('<option value="' + programStudi
                                .id + '">' +
                                programStudi.jenjang_pendidikan + ' ' + programStudi
                                .nama_program_studi + '</option>');
                        });
                    },
                    error: function() {
                        Swal.fire('Error!',
                            'Unable to fetch Program Studi data. Please try again later.',
                            'error');
                    }
                });
            });

            $('#createKelompokUktForm').on('submit', function(event) {
                event.preventDefault();
                stripCurrencyBeforeSubmit($(this));
                $.ajax({
                    url: "{{ route('kelompok-ukt.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#createKelompokUktModal').modal('hide');
                            $('#createKelompokUktForm')[0].reset();
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

            function formatCurrency(input) {
                let value = input.value.replace(/[^,\d]/g, '').toString();
                let split = value.split(',');
                let remainder = split[0].length % 3;
                let currency = split[0].substr(0, remainder);
                let thousand = split[0].substr(remainder).match(/\d{3}/gi);

                if (thousand) {
                    let separator = remainder ? '.' : '';
                    currency += separator + thousand.join('.');
                }

                currency = split[1] !== undefined ? currency + ',' + split[1] : currency;
                input.value = currency;
            }

            // Function to strip formatting
            function stripCurrency(value) {
                return value.replace(/[^,\d]/g, '').replace(',', '.');
            }

            function stripCurrencyBeforeSubmit(form) {
                let nominalKelompokUkt = form.find('[name="nominal_kelompok_ukt"]');
                nominalKelompokUkt.val(stripCurrency(nominalKelompokUkt.val()));
            }

            // Apply formatting on keyup and blur events for both create and edit forms
            $('#nominal_kelompok_ukt, #edit_nominal_kelompok_ukt').on('keyup blur', function() {
                formatCurrency(this);
            });

            $('#editKelompokUktForm').on('submit', function(event) {
                event.preventDefault();
                stripCurrencyBeforeSubmit($(this));
                var id = $('#edit_id').val();
                $.ajax({
                    url: "{{ route('kelompok-ukt.update', ':id') }}".replace(':id', id),
                    method: "PUT",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#editKelompokUktModal').modal('hide');
                            $('#editKelompokUktForm')[0].reset();
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

            window.editKelompokUkt = function(id) {
                $.ajax({
                    url: "{{ route('kelompok-ukt.show', ':id') }}".replace(':id', id),
                    method: "GET",
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        $('#edit_nama_kelompok_ukt').val(data.nama_kelompok_ukt);
                        $('#edit_nominal_kelompok_ukt').val(data.nominal_kelompok_ukt);

                        // Fetch program studi options and set the selected value
                        $.ajax({
                            url: "{{ route('program-studi.list-to-mahasiswa') }}",
                            method: "GET",
                            success: function(programStudiData) {
                                var programStudiSelect = $('#edit_id_program_studi');
                                programStudiSelect.empty();
                                $.each(programStudiData, function(key, programStudi) {
                                    var isSelected = programStudi.id === data
                                        .id_program_studi ? 'selected' : '';
                                    programStudiSelect.append(
                                        '<option value="' + programStudi
                                        .id + '" ' + isSelected + '>' +
                                        programStudi.nama_jurusan + ' - ' +
                                        programStudi.jenjang_pendidikan +
                                        ' ' +
                                        programStudi.nama_program_studi +
                                        '</option>'
                                    );
                                });
                                // Set the selected value and trigger change
                                programStudiSelect.val(data.id_program_studi).trigger(
                                    'change');
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'Unable to fetch Jurusan data. Please try again later.',
                                    'error');
                            }
                        });

                        $('#editKelompokUktModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Unable to fetch data. Please try again later.',
                            'error');
                    }
                });
            };

            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Menghapus Kelompok Ukt',
                    text: "Mau menghapus Kelompok Ukt ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('kelompok-ukt.destroy', ['kelompok_ukt' => ':id']) }}'
                                .replace(':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire('Kelompok Ukt Dihapus!', data.message,
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

            function resetValidationErrors() {
                $('.text-danger').text('');
                $('.form-control').removeClass('is-invalid');
            }

            function setValidationErrors(errors, formType) {
                if (errors.nama_kelompok_ukt) {
                    $('#' + formType + '_nama_kelompok_ukt').addClass('is-invalid');
                    $('#' + formType + '_nama_kelompok_ukt_error').text(errors.nama_kelompok_ukt[0]);
                }
                if (errors.nominal_kelompok_ukt) {
                    $('#' + formType + '_nominal_kelompok_ukt').addClass('is-invalid');
                    $('#' + formType + '_nominal_kelompok_ukt_error').text(errors.nominal_kelompok_ukt[0]);
                }
            }
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
