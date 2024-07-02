@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>List Mahasiswa Proses Diverifikasi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            @php
                                $periode = \App\Models\Periode::where('status_periode', '=', 'Aktif')->first();
                            @endphp
                            @if (!$periode)
                                <div class="alert alert-danger" role="alert">
                                    Tidak ada periode aktif. Silahkan buat periode terlebih dahulu.
                                </div>
                            @else
                                <div class="card-header-action">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#createMahasiswaModal">Tambah
                                        Mahasiswa</button>
                                    <a class="btn btn-info btn-primary active import" data-id="import"> <i
                                            class="fa fa-download" aria-hidden="true"></i>Import Mahasiswa</a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="show-import" style="display: none">
                                @error('import-file')
                                    <div class="invalid-feedback d-flex mb-10" role="alert">
                                        <div class="alert_alert-dange_mt-1_mb-1">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                                <div class="custom-file">
                                    <form action="{{ route('mahasiswa.import') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <label class="custom-file-label" for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import-file"
                                            data-id="send-import">
                                        <br /> <br />
                                        <div class="footer text-right">
                                            <button class="btn btn-primary" data-id="submit-import">Import File</button>
                                        </div>
                                    </form>
                                </div>
                                <br><br><br>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mahasiswa-data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Program Studi</th>
                                            <th>Periode</th>
                                            <th>Status Verifikasi</th>
                                            <th>Details</th>
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
    @include('Kemahasiswaan.mahasiswa.modal-create')
    @include('Kemahasiswaan.mahasiswa.modal-edit')
    @include('Kemahasiswaan.mahasiswa.modal-edit-status')
    @include('Kemahasiswaan.mahasiswa.modal-foto')
@endsection

@push('customScript')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });

        function submitDel(id) {
            $('#del-' + id).submit()
        }
    </script>
    <script>
        function showImageModal(img) {
            var src = img.src;
            var modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            $('#imageModal').modal('show');
        }
    </script>

    <script>
        $('#status_verifikasi').select2();

        function showStatusModal(id) {
            $.ajax({
                url: "{{ route('mahasiswa.show', ':id') }}".replace(':id', id),
                method: "GET",
                success: function(data) {
                    $('#status_mahasiswa_id').val(data.id);
                    $('#status_verifikasi').val(data.status_verifikasi).trigger('change');
                    $('#statusVerifikasiModal').modal('show');
                },
                error: function() {
                    Swal.fire('Error!', 'Unable to fetch data. Please try again later.', 'error');
                }
            });
        }
        $(document).ready(function() {
            var table = $('.mahasiswa-data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mahasiswa.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_mahasiswa',
                        name: 'nama_mahasiswa'
                    },
                    {
                        data: 'nim_mahasiswa',
                        name: 'nim_mahasiswa'
                    },
                    {
                        data: 'jurusan.nama_jurusan',
                        name: 'jurusan.nama_jurusan',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'program_studi',
                        name: 'program_studi',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'id_periode',
                        name: 'id_periode'
                    },
                    {
                        data: 'status_verifikasi',
                        name: 'status_verifikasi'
                    },
                    {
                        data: 'details',
                        name: 'details',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<button class="btn btn-info btn-sm" data-id="${row.id}"><i class="fas fa-chevron-down"></i></button>`;
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

            $('.mahasiswa-data-table tbody').on('click', 'td button', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var id = $(this).data('id');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    $.ajax({
                        url: "{{ route('mahasiswa.details', ':id') }}".replace(':id', id),
                        method: 'GET',
                        success: function(data) {
                            row.child(data).show();
                            tr.addClass('shown');
                            const currencyFields = document.querySelectorAll('.currency');
                            currencyFields.forEach(function(field) {
                                field.textContent = 'Rp. ' + formatRupiah(field
                                    .textContent);
                            });
                        }
                    });
                }
            });

            $('#createMahasiswaModal, #editMahasiswaModal').on('hidden.bs.modal', function() {
                $(this).find('.text-danger').text('');
                $(this).find('.form-control').removeClass('is-invalid');
            });

            $('#createMahasiswaModal').on('show.bs.modal', function() {
                $.ajax({
                    url: "{{ route('program-studi.list-to-mahasiswa') }}",
                    method: "GET",
                    success: function(data) {
                        var programStudiSelect = $('#id_program_studi');
                        programStudiSelect.empty();
                        programStudiSelect.append('<option value="">Pilih Data</option>');
                        $.each(data, function(key, programStudi) {
                            programStudiSelect.append('<option value="' + programStudi
                                .id + '">' +
                                programStudi.nama_jurusan + ' - ' + programStudi
                                .jenjang_pendidikan + ' ' +
                                programStudi.nama_program_studi + '</option>');
                        });
                    },
                    error: function() {
                        Swal.fire('Error!',
                            'Unable to fetch Jurusan data. Please try again later.', 'error'
                        );
                    }
                });

                $('#id_program_studi').on('change', function() {
                    var id = $(this).val();
                    if (id) {
                        $.ajax({
                            url: "{{ route('mahasiswa.kelompok-ukt-list', ':id') }}"
                                .replace(':id', id),
                            method: 'GET',
                            success: function(data) {
                                var kelompokUktSelect = $('#id_kelompok_ukt');
                                kelompokUktSelect.empty();
                                kelompokUktSelect.append(
                                    '<option value="">Pilih Kelompok UKT</option>');
                                $.each(data, function(key, kelompokUkt) {
                                    kelompokUktSelect.append('<option value="' +
                                        kelompokUkt.id + '">' +
                                        'Kelompok ' +
                                        kelompokUkt.nama_kelompok_ukt +
                                        ' - ' + 'Rp. ' + kelompokUkt
                                        .nominal_kelompok_ukt +
                                        '</option>');
                                });
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'Unable to fetch Kelompok UKT data. Please try again later.',
                                    'error');
                            }
                        });
                    } else {
                        $('#id_kelompok_ukt').empty();
                        $('#id_kelompok_ukt').append(
                            '<option value="">Pilih Kelompok UKT</option>');
                    }
                });
            });


            $('#createMahasiswaForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('mahasiswa.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#createMahasiswaModal').modal('hide');
                            $('#createMahasiswaForm')[0].reset();
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

            window.editMahasiswa = function(id) {
                $.ajax({
                    url: "{{ route('mahasiswa.show', ':id') }}".replace(':id', id),
                    method: "GET",
                    success: function(data) {
                        console.log(data); // Add this line
                        $('#edit_id').val(data.id);
                        $('#edit_nama_mahasiswa').val(data.nama_mahasiswa);
                        $('#edit_nim_mahasiswa').val(data.nim_mahasiswa);
                        $('#edit_angkatan_mahasiswa').val(data.angkatan_mahasiswa);
                        $('#edit_semester_mahasiswa').val(data.semester_mahasiswa);

                        // Set the selected value for semester
                        var semester = data.semester_mahasiswa;
                        if (semester.toString().slice(-1) == '1') {
                            $('#edit_semester_mahasiswa').val('ganjil').trigger('change');
                        } else if (semester.toString().slice(-1) == '2') {
                            $('#edit_semester_mahasiswa').val('genap').trigger('change');
                        }

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
                                        ' ' + programStudi
                                        .nama_program_studi + '</option>');
                                });
                                programStudiSelect.val(data.id_program_studi).trigger(
                                    'change');
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'Unable to fetch Jurusan data. Please try again later.',
                                    'error');
                            }
                        });

                        $.ajax({
                            url: "{{ route('mahasiswa.kelompok-ukt-list', ':id') }}"
                                .replace(':id', data.id_program_studi),
                            method: "GET",
                            success: function(kelompokUktData) {
                                var kelompokUktSelect = $('#edit_id_kelompok_ukt');
                                kelompokUktSelect.empty();
                                kelompokUktSelect.append(
                                    '<option value="">Pilih Kelompok UKT</option>');
                                $.each(kelompokUktData, function(key, kelompokUkt) {
                                    var isSelected = kelompokUkt.id === data
                                        .id_kelompok_ukt ? 'selected' : '';
                                    kelompokUktSelect.append('<option value="' +
                                        kelompokUkt.id + '" ' + isSelected +
                                        '>Kelompok ' + kelompokUkt
                                        .nama_kelompok_ukt + ' - Rp. ' +
                                        kelompokUkt.nominal_kelompok_ukt +
                                        '</option>');
                                });
                                kelompokUktSelect.val(data.id_kelompok_ukt).trigger(
                                    'change');
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'Unable to fetch Kelompok UKT data. Please try again later.',
                                    'error');
                            }
                        });

                        $('#edit_jalur_masuk').val(data.jalur_masuk).trigger('change');
                        $('#editMahasiswaModal').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Unable to fetch data. Please try again later.',
                            'error');
                    }
                });
            };

            $('#editMahasiswaForm').on('submit', function(event) {
                event.preventDefault();
                var id = $('#edit_id').val();
                var formData = $(this).serializeArray();
                console.log(formData); // Log data yang akan dikirim

                $.ajax({
                    url: "{{ route('mahasiswa.update', ':id') }}".replace(':id', id),
                    method: "PUT",
                    data: formData,
                    success: function(data) {
                        if (data.success) {
                            $('#editMahasiswaModal').modal('hide');
                            $('#editMahasiswaForm')[0].reset();
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



            $('#statusVerifikasiForm').on('submit', function(event) {
                event.preventDefault();
                var id = $('#status_mahasiswa_id').val();
                var status = $('#status_verifikasi').val();
                $.ajax({
                    url: "{{ route('mahasiswa.update-status', ':id') }}".replace(':id', id),
                    method: "PUT",
                    data: {
                        _token: '{{ csrf_token() }}',
                        status_verifikasi: status
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#statusVerifikasiModal').modal('hide');
                            $('#statusVerifikasiForm')[0].reset();
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
                            setValidationErrors(errors, 'status');
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
                if (errors.nama_mahasiswa) {
                    $('#nama_mahasiswa').addClass('is-invalid');
                    $('#create_nama_mahasiswa_error').text(errors.nama_mahasiswa[0]);
                }
                if (errors.nim_mahasiswa) {
                    $('#nim_mahasiswa').addClass('is-invalid');
                    $('#create_nim_mahasiswa_error').text(errors.nim_mahasiswa[0]);
                }
                if (errors.angkatan_mahasiswa) {
                    $('#angkatan_mahasiswa').addClass('is-invalid');
                    $('#create_angkatan_mahasiswa_error').text(errors.angkatan_mahasiswa[0]);
                }
                if (errors.semester_mahasiswa) {
                    $('#semester_mahasiswa').addClass('is-invalid');
                    $('#create_semester_mahasiswa_error').text(errors.semester_mahasiswa[0]);
                }
                if (errors.id_program_studi) {
                    $('#id_program_studi').addClass('is-invalid');
                    $('#create_id_program_studi_error').text(errors.id_program_studi[0]);
                }
                if (errors.id_kelompok_ukt) {
                    $('#id_kelompok_ukt').addClass('is-invalid');
                    $('#create_id_kelompok_ukt_error').text(errors.id_kelompok_ukt[0]);
                }
            }

            window.confirmDelete = function(id) {
                Swal.fire({
                    title: 'Menghapus Mahasiswa',
                    text: "Mau menghapus Mahasiswa ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('mahasiswa.destroy', ['mahasiswa' => ':id']) }}'
                                .replace(':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire('Mahasiswa Dihapus!', data.message,
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

        function formatRupiah(number) {
            let numberString = number.toString();
            let sisa = numberString.length % 3;
            let rupiah = numberString.substr(0, sisa);
            let ribuan = numberString.substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const currencyFields = document.querySelectorAll('.currency');
            console.log(currencyFields);
            currencyFields.forEach(function(field) {
                field.textContent = 'Rp. ' + formatRupiah(field.textContent);
            });
        });
    </script>
@endpush

@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <style>
        .details-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: left;
        }

        .details-table td,
        .details-table th {
            padding: 8px;
            vertical-align: middle;
        }

        .details-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .details-table label h6 {
            margin-bottom: 0;
            margin-top: 1em;
            font-weight: bold;
        }
    </style>
@endpush
