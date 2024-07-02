<table class="table table-bordered details-table">
    <label>
        <h6>Data Kelompok UKT Mahasiswa</h6>
    </label>
    <tr>
        <th>Kelompok UKT</th>
        <th>Kelompok UKT Perhitungan</th>
        <th>Keterangan</th>
    </tr>
    <tr>
        <td>Kelompok {{ $mahasiswa->kelompokUkt->nama_kelompok_ukt }} -
            <span class="currency">{{ $mahasiswa->kelompokUkt->nominal_kelompok_ukt }}</span>
        </td>
        <td>Kelompok {{ $mahasiswa->kelompokUktBaru->nama_kelompok_ukt }} -
            <span class="currency">{{ $mahasiswa->kelompokUktBaru->nominal_kelompok_ukt }}</span>
        </td>
        <td>{!! $mahasiswa->histori_perhitungan_mahasiswa !!}</td>
    </tr>
</table>

<table class="table table-bordered details-table">
    <label>
        <h6>Data Tambahan Mahasiswa</h6>
    </label>
    <tr>
        <th>Angkatan Mahasiswa</th>
        <th>Semester Mahasiswa</th>
        <th>Jalur Masuk</th>
    </tr>
    <tr>
        <td>{{ $mahasiswa->angkatan_mahasiswa }}</td>
        <td>{{ $mahasiswa->semester_mahasiswa }}</td>
        <td>{{ $mahasiswa->jalur_masuk }}</td>
    </tr>
</table>

<table class="table table-bordered details-table">
    <label>
        <h6>Data Orang Tua</h6>
    </label>
    <tr>
        <th>Alamat Orang Tua</th>
        <th>No. HP Aktif</th>
        <th>No. Telp Ayah</th>
    </tr>
    <tr>
        <td>{{ $mahasiswa->alamat_ortu }}</td>
        <td>{{ $mahasiswa->no_hp_aktif }}</td>
        <td>{{ $mahasiswa->no_telp_ayah }}</td>
    </tr>
    <tr>
        <td colspan="3" class="text-center">
            @if ($mahasiswa->foto_keluarga)
                <img src="{{ Storage::url($mahasiswa->foto_keluarga) }}" alt="Foto Keluarga" class="img-thumbnail"
                    style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
    </tr>
</table>

<table class="table table-bordered details-table">
    <label>
        <h6>Data Pekerjaan Orang Tua</h6>
    </label>
    <tr>
        <th>Pekerjaan Ayah</th>
        <th>Pekerjaan Ibu</th>
        <th>Penghasilan Ayah</th>
        <th>Penghasilan Ibu</th>
        <th>Penghasilan Gabungan</th>
    </tr>
    <tr>
        <td>{{ $mahasiswa->pekerjaan_ayah }}</td>
        <td>{{ $mahasiswa->pekerjaan_ibu }}</td>
        <td class="currency">{{ $mahasiswa->penghasilan_ayah }}</td>
        <td class="currency">{{ $mahasiswa->penghasilan_ibu }}</td>
        <td class="currency">{{ $mahasiswa->penghasilan_gabungan }}</td>
    </tr>
    <tr>
        <td class="text-center">
            @if ($mahasiswa->foto_pekerjaan_ayah)
                <img src="{{ Storage::url($mahasiswa->foto_pekerjaan_ayah) }}" alt="Foto Pekerjaan Ayah"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
        <td class="text-center">
            @if ($mahasiswa->foto_pekerjaan_ibu)
                <img src="{{ Storage::url($mahasiswa->foto_pekerjaan_ibu) }}" alt="Foto Pekerjaan Ibu"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
        <td class="text-center" colspan="3">
            @if ($mahasiswa->foto_penghasilan_ayah)
                <img src="{{ Storage::url($mahasiswa->foto_penghasilan_ayah) }}" alt="Foto Penghasilan Ayah"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
            @if ($mahasiswa->foto_penghasilan_ibu)
                <img src="{{ Storage::url($mahasiswa->foto_penghasilan_ibu) }}" alt="Foto Penghasilan Ibu"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
            @if ($mahasiswa->foto_penghasilan_gabungan)
                <img src="{{ Storage::url($mahasiswa->foto_penghasilan_gabungan) }}" alt="Foto Penghasilan Gabungan"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
    </tr>
</table>

<table class="table table-bordered details-table">
    <label>
        <h6>Data Kondisi Dirumah</h6>
    </label>
    <tr>
        <th>Jumlah Tanggungan</th>
        <th>Anak yang Ditanggung</th>
        <th>Status Orang Tua</th>
    </tr>
    <tr>
        <td>{{ $mahasiswa->jml_tanggungan }} orang</td>
        <td>{{ $mahasiswa->anak_di_tanggung }} orang</td>
        <td>{{ $mahasiswa->status_ortu }}</td>
    </tr>
    <tr>
        <td colspan="3" class="text-center">
            @if ($mahasiswa->foto_keluarga)
                <img src="{{ Storage::url($mahasiswa->foto_keluarga) }}" alt="Foto Keluarga" class="img-thumbnail"
                    style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
    </tr>
</table>

<table class="table table-bordered details-table">
    <label>
        <h6>Data Kondisi Pembayaran</h6>
    </label>
    <tr>
        <th>Besaran PDAM</th>
        <th>Besaran PLN</th>
        <th>Pajak Mobil</th>
        <th>Pajak Motor</th>
    </tr>
    <tr>
        <td class="currency">{{ $mahasiswa->besaran_pdam }}</td>
        <td class="currency">{{ $mahasiswa->besaran_pln }}</td>
        <td class="currency">{{ $mahasiswa->pajak_mobil }}</td>
        <td class="currency">{{ $mahasiswa->pajak_motor }}</td>
    </tr>
    <tr>
        <td class="text-center">
            @if ($mahasiswa->foto_pembayaran_pdam)
                <img src="{{ Storage::url($mahasiswa->foto_pembayaran_pdam) }}" alt="Foto Pembayaran PDAM"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
        <td class="text-center">
            @if ($mahasiswa->foto_pembayaran_pln)
                <img src="{{ Storage::url($mahasiswa->foto_pembayaran_pln) }}" alt="Foto Pembayaran PLN"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
        <td class="text-center">
            @if ($mahasiswa->foto_pajak_mobil)
                <img src="{{ Storage::url($mahasiswa->foto_pajak_mobil) }}" alt="Foto Pajak Mobil"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
        <td class="text-center">
            @if ($mahasiswa->foto_pajak_motor)
                <img src="{{ Storage::url($mahasiswa->foto_pajak_motor) }}" alt="Foto Pajak Motor"
                    class="img-thumbnail" style="max-width: 100%;" onclick="showImageModal(this)">
            @else
                <p>Tidak ada foto</p>
            @endif
        </td>
    </tr>
</table>
