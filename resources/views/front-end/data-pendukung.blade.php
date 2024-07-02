<form id="biodataForm" action="{{ route('front-end.biodata-pendukung-store') }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="py-3">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="alamat_ortu">Alamat Orang Tua</label>
                <textarea class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu"
                    placeholder="Masukkan alamat orang tua" {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>{{ old('alamat_ortu', $biodata ? $biodata->alamat_ortu : '') }}</textarea>
                @error('alamat_ortu')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="no_hp_aktif">No. HP Aktif</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;"><i
                                class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control @error('no_hp_aktif') is-invalid @enderror"
                        id="no_hp_aktif" name="no_hp_aktif" placeholder="Masukkan no. HP aktif"
                        value="{{ old('no_hp_aktif', $biodata ? $biodata->no_hp_aktif : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    @error('no_hp_aktif')
                        <div class="invalid-feedback feed ml-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="no_telp_ayah">No. Telp Ayah</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;"><i
                                class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control @error('no_telp_ayah') is-invalid @enderror"
                        id="no_telp_ayah" name="no_telp_ayah" placeholder="Masukkan no. telp ayah"
                        value="{{ old('no_telp_ayah', $biodata ? $biodata->no_telp_ayah : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    @error('no_telp_ayah')
                        <div class="invalid-feedback feed ml-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="foto">Foto Bukti Pekerjaan Ayah</label><br>
                @if ($biodata)
                    @if ($biodata->foto_pekerjaan_ayah)
                        <img class="ml-3 mb-2" id="pekerjaan-ayah-preview"
                            src="{{ Storage::url($biodata->foto_pekerjaan_ayah) }}" alt="pekerjaan-ayah"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pekerjaan-ayah-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="pekerjaan-ayah"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pekerjaan-ayah-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                        alt="pekerjaan-ayah" style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_pekerjaan_ayah" id="foto-pekerjaan-ayah"
                    class="form-control @error('foto_pekerjaan_ayah') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_pekerjaan_ayah')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="pekerjaan_ayah" class="mt-3">Pekerjaan Ayah</label>
                <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                    id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Masukkan pekerjaan ayah"
                    value="{{ old('pekerjaan_ayah', $biodata ? $biodata->pekerjaan_ayah : '') }}"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('pekerjaan_ayah')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="foto">Foto Bukti Pekerjaan Ibu</label><br>
                @if ($biodata)
                    @if ($biodata->foto_pekerjaan_ibu)
                        <img class="ml-3 mb-2" id="pekerjaan-ibu-preview"
                            src="{{ Storage::url($biodata->foto_pekerjaan_ibu) }}" alt="pekerjaan-ibu"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pekerjaan-ibu-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="pekerjaan-ibu"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pekerjaan-ibu-preview" src="{{ asset('assets/img/default-img.jpg') }}"
                        alt="pekerjaan-ibu" style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_pekerjaan_ibu" id="foto-pekerjaan-ibu"
                    class="form-control @error('foto_pekerjaan_ibu') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_pekerjaan_ibu')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="pekerjaan_ibu" class="mt-3">Pekerjaan Ibu</label>
                <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                    id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Masukkan pekerjaan ibu"
                    value="{{ old('pekerjaan_ibu', $biodata ? $biodata->pekerjaan_ibu : '') }}"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('pekerjaan_ibu')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row justify-content-center mt-3">
            <div class="form-group col-md-6 text-center">
                <label for="foto">Foto Bukti Kartu Keluarga</label><br>
                @if ($biodata)
                    @if ($biodata->foto_keluarga)
                        <img class="ml-3 mb-2" id="foto-keluarga-preview"
                            src="{{ Storage::url($biodata->foto_keluarga) }}" alt="foto_keluarga"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">* Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png,
                            .jpg, atau .jpeg)</p>
                        <p class="ml-4 mb-2 m-0 p-0 text-b">* Foto Kartu Keluarga digunakan bukti Jumlah Tanggungan,
                            Anak yang ditanggung, dan Status Orang Tua</p>
                    @else
                        <img class="ml-3 mb-2" id="foto-keluarga-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-keluarga"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png,
                            .jpg, atau .jpeg)</p>
                        <p class="ml-4 mb-2 m-0 p-0 text-c">* Foto Kartu Keluarga digunakan bukti Jumlah Tanggungan,
                            Anak yang ditanggung, dan Status Orang Tua</p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="foto-keluarga-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-keluarga"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">* Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg,
                        atau .jpeg)</p>
                    <p class="ml-4 mb-2 m-0 p-0 text-c">* Foto Kartu Keluarga digunakan bukti Jumlah Tanggungan,
                        Anak yang ditanggung, dan Status Orang Tua</p>
                @endif
                <input type="file" name="foto_keluarga" id="foto-keluarga"
                    class="form-control @error('foto_keluarga') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_keluarga')
                    <div class="invalid-feedback feed ml-3">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 mt-3">
                <label for="jml_tanggungan">Jumlah Tanggungan</label>
                <input type="number" class="form-control @error('jml_tanggungan') is-invalid @enderror"
                    id="jml_tanggungan" name="jml_tanggungan" placeholder="Masukkan jumlah tanggungan"
                    value="{{ old('jml_tanggungan', $biodata ? $biodata->jml_tanggungan : '') }}"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('jml_tanggungan')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6 mt-3">
                <label for="anak_di_tanggung">Anak yang Ditanggung</label>
                <input type="number" class="form-control @error('anak_di_tanggung') is-invalid @enderror"
                    id="anak_di_tanggung" name="anak_di_tanggung" placeholder="Masukkan jumlah anak yang ditanggung"
                    value="{{ old('anak_di_tanggung', $biodata ? $biodata->anak_di_tanggung : '') }}"
                    {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('anak_di_tanggung')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 mt-3">
                <label for="status_ortu">Status Orang Tua</label>
                <select class="form-control select2 @error('status_ortu') is-invalid @enderror" id="status_ortu"
                    name="status_ortu" {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                    <option value="" selected disabled>Pilih Status</option>
                    <option value="Duda"
                        {{ old('status_ortu', $biodata ? $biodata->status_ortu : '') == 'Duda' ? 'selected' : '' }}>
                        Duda
                    </option>
                    <option value="Janda"
                        {{ old('status_ortu', $biodata ? $biodata->status_ortu : '') == 'Janda' ? 'selected' : '' }}>
                        Janda
                    </option>
                    <option value="Lengkap"
                        {{ old('status_ortu', $biodata ? $biodata->status_ortu : '') == 'Lengkap' ? 'selected' : '' }}>
                        Lengkap</option>
                </select>
                @error('status_ortu')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <!-- Penghasilan Ayah -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Penghasilan Ayah</label><br>
                @if ($biodata)
                    @if ($biodata->foto_penghasilan_ayah)
                        <img class="ml-3 mb-2" id="pengasilan-ayah-preview"
                            src="{{ Storage::url($biodata->foto_penghasilan_ayah) }}" alt="penghasilan-ayah"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pengasilan-ayah-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="penghasilan-ayah"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pengasilan-ayah-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="penghasilan-ayah"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_penghasilan_ayah" id="foto-penghasilan-ayah"
                    class="form-control @error('foto_penghasilan_ayah') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_penghasilan_ayah')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="penghasilan_ayah" class="mt-3">Penghasilan Ayah</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('penghasilan_ayah') is-invalid @enderror"
                        id="penghasilan_ayah" name="penghasilan_ayah" placeholder="Masukkan penghasilan ayah"
                        value="{{ old('penghasilan_ayah', $biodata ? number_format($biodata->penghasilan_ayah, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('penghasilan_ayah')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- Penghasilan Ibu -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Penghasilan Ibu</label><br>
                @if ($biodata)
                    @if ($biodata->foto_penghasilan_ibu)
                        <img class="ml-3 mb-2" id="penghasilan-ibu-preview"
                            src="{{ Storage::url($biodata->foto_penghasilan_ibu) }}" alt="penghasilan-ibu"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="penghasilan-ibu-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="penghasilan-ibu"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="penghasilan-ibu-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="penghasilan-ibu"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_penghasilan_ibu" id="foto-penghasilan-ibu"
                    class="form-control @error('foto_penghasilan_ibu') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_penghasilan_ibu')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="penghasilan_ibu" class="mt-3">Penghasilan Ibu</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('penghasilan_ibu') is-invalid @enderror"
                        id="penghasilan_ibu" name="penghasilan_ibu" placeholder="Masukkan penghasilan ibu"
                        value="{{ old('penghasilan_ibu', $biodata ? number_format($biodata->penghasilan_ibu, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('penghasilan_ibu')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Penghasilan Gabungan -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Penghasilan Gabungan</label><br>
                @if ($biodata)
                    @if ($biodata->foto_penghasilan_gabungan)
                        <img class="ml-3 mb-2" id="penghasilan-gabungan-preview"
                            src="{{ Storage::url($biodata->foto_penghasilan_gabungan) }}" alt="penghasilan-gabungan"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="penghasilan-gabungan-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="penghasilan-gabungan"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="penghasilan-gabungan-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="penghasilan-gabungan"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_penghasilan_gabungan" id="foto-penghasilan-gabungan"
                    class="form-control @error('foto_penghasilan_gabungan') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_penghasilan_gabungan')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="penghasilan_gabungan" class="mt-3">Penghasilan Gabungan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('penghasilan_gabungan') is-invalid @enderror"
                        id="penghasilan_gabungan" name="penghasilan_gabungan"
                        placeholder="Masukkan penghasilan gabungan"
                        value="{{ old('penghasilan_gabungan', $biodata ? number_format($biodata->penghasilan_gabungan, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('penghasilan_gabungan')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <!-- Besaran PLN -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Pembayaran PLN</label><br>
                @if ($biodata)
                    @if ($biodata->foto_pembayaran_pln)
                        <img class="ml-3 mb-2" id="pembayaran-pln-preview"
                            src="{{ Storage::url($biodata->foto_pembayaran_pln) }}" alt="pembayaran-pln"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pembayaran-pln-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pln"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pembayaran-pln-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pln"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_pembayaran_pln" id="foto-pembayaran-pln"
                    class="form-control @error('foto_pembayaran_pln') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_pembayaran_pln')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="besaran_pln" class="mt-3">Besaran PLN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('besaran_pln') is-invalid @enderror"
                        id="besaran_pln" name="besaran_pln" placeholder="Masukkan besaran PLN"
                        value="{{ old('besaran_pln', $biodata ? number_format($biodata->besaran_pln, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('besaran_pln')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Besaran PDAM -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Pembayaran PDAM</label><br>
                @if ($biodata)
                    @if ($biodata->foto_pembayaran_pdam)
                        <img class="ml-3 mb-2" id="pembayaran-pdam-preview"
                            src="{{ Storage::url($biodata->foto_pembayaran_pdam) }}" alt="pembayaran-pdam"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pembayaran-pdam-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pdam"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pembayaran-pdam-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pdam"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_pembayaran_pdam" id="foto-pembayaran-pdam"
                    class="form-control @error('foto_pembayaran_pdam') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_pembayaran_pdam')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="besaran_pdam" class="mt-3">Besaran PDAM</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('besaran_pdam') is-invalid @enderror"
                        id="besaran_pdam" name="besaran_pdam" placeholder="Masukkan besaran PDAM"
                        value="{{ old('besaran_pdam', $biodata ? number_format($biodata->besaran_pdam, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('besaran_pdam')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <!-- Pajak Mobil -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Pembayaran Pajak Mobil</label><br>
                @if ($biodata)
                    @if ($biodata->foto_pajak_mobil)
                        <img class="ml-3 mb-2" id="pembayaran-pajak-mobil-preview"
                            src="{{ Storage::url($biodata->foto_pajak_mobil) }}" alt="pembayaran-pajak-mobil"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pembayaran-pajak-mobil-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pajak-mobil"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pembayaran-pajak-mobil-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pajak-mobil"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_pajak_mobil" id="foto-pembayaran-pajak-mobil"
                    class="form-control @error('foto_pajak_mobil') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_pajak_mobil')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="pajak_mobil" class="mt-3">Pajak Mobil</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('pajak_mobil') is-invalid @enderror"
                        id="pajak_mobil" name="pajak_mobil" placeholder="Masukkan pajak mobil"
                        value="{{ old('pajak_mobil', $biodata ? number_format($biodata->pajak_mobil, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('pajak_mobil')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Pajak Motor -->
            <div class="form-group col-md-6 mt-3">
                <label for="foto">Foto Bukti Pembayaran Pajak Motor</label><br>
                @if ($biodata)
                    @if ($biodata->foto_pajak_motor)
                        <img class="ml-3 mb-2" id="pembayaran-pajak-motor-preview"
                            src="{{ Storage::url($biodata->foto_pajak_motor) }}" alt="pembayaran-pajak-motor"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-b">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @else
                        <img class="ml-3 mb-2" id="pembayaran-pajak-motor-preview"
                            src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pajak-motor"
                            style="width: 350px; height: 150px; object-fit: contain;">
                        <p class="ml-4 mb-2 m-0 p-0 text-c">
                            * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                        </p>
                    @endif
                @else
                    <img class="ml-3 mb-2" id="pembayaran-pajak-motor-preview"
                        src="{{ asset('assets/img/default-img.jpg') }}" alt="pembayaran-pajak-motor"
                        style="width: 350px; height: 150px; object-fit: contain;">
                    <p class="ml-4 mb-2 m-0 p-0 text-c">
                        * Ukuran file maksimal 2 MB (2048 KB) | Ektensi (.png, .jpg, atau .jpeg)
                    </p>
                @endif
                <input type="file" name="foto_pajak_motor" id="foto-pembayaran-pajak-motor"
                    class="form-control @error('foto_pajak_motor') is-invalid @enderror"
                    {{ $biodata?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                @error('foto_pajak_motor')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
                <label for="pajak_motor" class="mt-3">Pajak Motor</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                    </div>
                    <input type="text" class="form-control @error('pajak_motor') is-invalid @enderror"
                        id="pajak_motor" name="pajak_motor" placeholder="Masukkan pajak motor"
                        value="{{ old('pajak_motor', $biodata ? number_format($biodata->pajak_motor, 0, ',', '.') : '') }}"
                        {{ $biodata?->status_verifikasi == 'Diverifikasi' ? 'disabled' : '' }}>
                </div>
                @error('pajak_motor')
                    <div class="invalid-feedback feed ml-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>
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
        function removeCurrencyFormatting() {
            const elements = document.querySelectorAll('input[type="text"]');
            elements.forEach((element) => {
                if (!element.id.includes('no_hp') && !element.id.includes('no_telp') && !element.id.includes(
                        'pekerjaan')) {
                    element.value = element.value.replace(/[.,]/g, '');
                }
            });
        }

        document.getElementById('biodataForm').addEventListener('submit', function(event) {
            removeCurrencyFormatting();
        });

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
                    const elements = document.querySelectorAll('input[type="text"]');
                    elements.forEach((element) => {
                        if (!element.id.includes('no_hp') && !element.id.includes('no_telp') && !element.id
                            .includes('pekerjaan')) {
                            element.value = element.value.replace(/[.,]/g, '');
                        }
                    });
                    document.getElementById('biodataForm').submit();
                }
            })
        }

        document.addEventListener('DOMContentLoaded', function() {
            const formatRupiah = (number) => {
                let numberString = number.replace(/[^,\d]/g, '').toString();
                let split = numberString.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            };

            const elements = document.querySelectorAll('input[type="text"]');
            elements.forEach((element) => {
                if (!element.id.includes('no_hp') && !element.id.includes('no_telp') && !element.id
                    .includes('pekerjaan')) {
                    element.addEventListener('keyup', (e) => {
                        e.target.value = formatRupiah(e.target.value);
                    });
                    element.value = formatRupiah(element.value);
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
    <script>
        $(document).ready(function() {
            $('#foto-pekerjaan-ayah').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pekerjaan-ayah-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-pekerjaan-ibu').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pekerjaan-ibu-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-keluarga').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-keluarga-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-penghasilan-ayah').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pengasilan-ayah-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-penghasilan-ibu').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#penghasilan-ibu-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-penghasilan-gabungan').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#penghasilan-gabungan-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-penghasilan-gabungan').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#penghasilan-gabungan-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-pembayaran-pln').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pembayaran-pln-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-pembayaran-pdam').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pembayaran-pdam-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-pembayaran-pajak-mobil').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pembayaran-pajak-mobil-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#foto-pembayaran-pajak-motor').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#pembayaran-pajak-motor-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

        });
    </script>
@endpush
