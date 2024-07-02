<!-- Create Mahasiswa Modal -->
<div class="modal fade" id="createMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="createMahasiswaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMahasiswaModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createMahasiswaForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa"
                            placeholder="Masukkan Nama Mahasiswa">
                        <span class="text-danger" id="create_nama_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="nim_mahasiswa">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" class="form-control" id="nim_mahasiswa" name="nim_mahasiswa"
                            placeholder="Masukkan Nomor Induk Mahasiswa (NIM)">
                        <span class="text-danger" id="create_nim_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="angkatan_mahasiswa">Angkatan Mahasiswa</label>
                        <input type="number" class="form-control" id="angkatan_mahasiswa" name="angkatan_mahasiswa"
                            placeholder="Masukkan Angkatan Mahasiswa">
                        <span class="text-danger" id="create_angkatan_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="semester_mahasiswa">Semester Mahasiswa</label>
                        <select class="form-control select2" id="semester_mahasiswa" name="semester_mahasiswa">
                            <option value="">Pilih Semester</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                        <span class="text-danger" id="create_semester_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="id_program_studi">Program Studi</label>
                        <select class="form-control select2" id="id_program_studi" name="id_program_studi">
                        </select>
                        <span class="text-danger" id="create_id_program_studi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="id_program_studi">Kelompok UKT</label>
                        <select class="form-control select2" id="id_kelompok_ukt" name="id_kelompok_ukt">
                        </select>
                        <span class="text-danger" id="create_id_kelompok_ukt_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="jalur_masuk">Jalur Masuk</label>
                        <select class="form-control select2" name="jalur_masuk" id="jalur_masuk">
                            <option value="" selected disabled>Jalur Masuk</option>
                            <option value="PSB/PMDK/SNMPN/SNMPTN">
                                PSB/PMDK/SNMPN/SNMPTN
                            </option>
                            <option value="UMPN PSDKU">
                                UMPN PSDKU
                            </option>
                            <option value="UMPN/SBMPN/SBMPTN">
                                UMPN/SBMPN/SBMPTN
                            </option>
                            <option value="Mandiri-1">
                                Mandiri-1
                            </option>
                            <option value="Mandiri-2">
                                Mandiri-2
                            </option>
                        </select>
                        <span class="text-danger" id="create_jalur_masuk_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
