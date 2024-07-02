<form action="{{ route('front-end.biodata-store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="py-3">
        <div class="form-group col-md-12 d-flex justify-content-start">
            <div class="form-group col-md-6">
                <label for="foto">Foto</label><br>
                @if ($biodata)
                    @if ($biodata->foto_mahasiswa)
                        <img id="foto-preview" class="mb-3 ml-3" src="{{ Storage::url($biodata->foto_mahasiswa) }}"
                            alt="foto" style="width: 300px; height: 400px; object-fit: cover;">
                    @else
                        <img id="foto-preview" class="ml-3" src="{{ asset('assets/img/profile.jpg') }}"
                            alt="foto-default" style="width: 300px; height: 400px; object-fit: cover;">
                        <p class="ml-4 mt-2 m-0 p-0 text-c">* Ukuran Foto 3x4</p>
                        <p class="ml-4 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB)</p>
                        <p class="ml-4 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
                        <p class="ml-4 mb-2 m-0 p-0 text-c">* Foto Formal (Tidak boleh swa foto)</p>
                    @endif
                @else
                    <img id="foto-preview" class="ml-3" src="{{ asset('assets/img/profile.jpg') }}" alt="foto-default"
                        style="width: 300px; height: 400px; object-fit: cover;">
                    <p class="ml-4 mt-2 m-0 p-0 text-c">* Ukuran Foto 3x4</p>
                    <p class="ml-4 m-0 p-0 text-c">* Ukuran foto maksimal 2 MB (2048 KB)</p>
                    <p class="ml-4 m-0 p-0 text-c">* Ekstensi (.png, .jpg, atau .jpeg)</p>
                    <p class="ml-4 mb-2 m-0 p-0 text-c">* Foto Formal (Tidak boleh swa foto)</p>
                @endif
                <input type="file" id="foto" class="form-control @error('foto_mahasiswa') is-invalid @enderror"
                    name="foto_mahasiswa" accept="image/*"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_mahasiswa')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12 d-flex justify-content-start">
            <div class="form-group col-md-6">
                <label for="nama_mahasiswa">Nama Mahasiswa<span style="color: red">*</span></label>
                <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                    id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $biodata ? $biodata->nama_mahasiswa : '' }}"
                    placeholder="Maksukkan nama lengkap anda"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('nama_mahasiswa')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="nim_mahasiswa">NIM Mahasiswa<span style
                    ="color: red">*</span></label>
                <input type="text" class="form-control @error('nim_mahasiswa') is-invalid @enderror"
                    id="nim_mahasiswa" name="nim_mahasiswa"
                    value="{{ old('nim_mahasiswa', $biodata ? $biodata->nim_mahasiswa : '') }}"
                    placeholder="Masukkan NIM anda" oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('nim_mahasiswa')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12 d-flex justify-content-start">
            <div class="form-group col-md-6">
                <label for="angkatan_mahasiswa">Angkatan Tahun<span style="color: red">*</span></label>
                <input type="text" class="form-control @error('angkatan_mahasiswa') is-invalid @enderror"
                    id="angkatan_mahasiswa" name="angkatan_mahasiswa"
                    value="{{ $biodata ? $biodata->angkatan_mahasiswa : '' }}" placeholder="Masukkan tahun masuk anda"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="4"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('angkatan_mahasiswa')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="semester_mahasiswa">Semester Mahasiswa<span style="color: red">*</span></label>
                <select class="form-control select2 @error('semester_mahasiswa') is-invalid @enderror"
                    id="semester_mahasiswa" name="semester_mahasiswa"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="">Pilih semester anda</option>
                    @php
                        $semester_mahasiswa = old('semester_mahasiswa', $biodata ? $biodata->semester_mahasiswa : '');
                        $semester_type = substr($semester_mahasiswa, -1) == '1' ? 'ganjil' : 'genap';
                    @endphp
                    <option value="ganjil" {{ $semester_type == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="genap" {{ $semester_type == 'genap' ? 'selected' : '' }}>Genap</option>
                </select>
                @error('semester_mahasiswa')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-12 d-flex justify-content-start">
            <div class="form-group col-md-6">
                <label for="id_program_studi">Jurusan - Program Studi<span style="color: red">*</span></label>
                <select class="form-control select2" name="id_program_studi" id="id_program_studi"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Pilih Data</option>
                    @foreach ($programStudi as $listProgramStudi)
                        <option value="{{ $listProgramStudi->id }}"
                            {{ isset($biodata) && $biodata->id_program_studi === $listProgramStudi->id ? 'selected' : '' }}>
                            {{ $listProgramStudi->nama_jurusan }} -
                            {{ $listProgramStudi->jenjang_pendidikan }} -
                            {{ $listProgramStudi->nama_program_studi }}
                        </option>
                    @endforeach
                </select>
                @error('id_program_studi')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="jalur_masuk">Jalur Masuk</label>
                <select class="form-control select2" name="jalur_masuk" id="jalur_masuk"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Jalur Masuk</option>
                    <option value="PSB/PMDK/SNMPN/SNMPTN"
                        {{ isset($biodata) && $biodata->jalur_masuk === 'PSB/PMDK/SNMPN/SNMPTN' ? 'selected' : '' }}>
                        PSB/PMDK/SNMPN/SNMPTN
                    </option>
                    <option value="UMPN PSDKU"
                        {{ isset($biodata) && $biodata->jalur_masuk === 'UMPN PSDKU' ? 'selected' : '' }}>
                        UMPN PSDKU
                    </option>
                    <option value="UMPN/SBMPN/SBMPTN"
                        {{ isset($biodata) && $biodata->jalur_masuk === 'UMPN/SBMPN/SBMPTN' ? 'selected' : '' }}>
                        UMPN/SBMPN/SBMPTN
                    </option>
                    <option value="Mandiri-1"
                        {{ isset($biodata) && $biodata->jalur_masuk === 'Mandiri-1' ? 'selected' : '' }}>
                        Mandiri
                    </option>
                    <option value="Mandiri-2"
                        {{ isset($biodata) && $biodata->jalur_masuk === 'Mandiri-2' ? 'selected' : '' }}>
                        Mandiri
                    </option>
                </select>
            </div>
            @error('jalur_masuk')
                <div class="invalid-feedback feed ml-3">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if (!$periodeAktif)
        @elseif ($periodeAktif && $biodata == null)
            <div class="mr-4 text-right btn-bio">
                <button class="btn btn-save px-5"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    Simpan
                </button>
            </div>
        @elseif (($periodeAktif && $biodata->status_verifikasi == 'Proses Diverifikasi') || $biodata->status_verifikasi == 'Pending')
            <div class="mr-4 text-right btn-bio">
                <button class="btn btn-save px-5"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    Simpan
                </button>
            </div>
        @elseif ($biodata->status_verifikasi == 'Ditolak' && $periodeAktif->id == $biodata->id_periode)

        @elseif ($periodeAktif->id != $biodata->id_periode)
            <div class="mr-4 text-right btn-bio">
                <button class="btn btn-save px-5"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    Simpan
                </button>
            </div>
        @endif
    </div>
</form>

@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menyimpan biodata ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('biodataForm').submit();
                }
            })
        }

        $(document).ready(function() {
            $('#foto').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data diri masih kosong.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    title: 'Gagal',
                    text: 'Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif


        });
    </script>
@endpush
