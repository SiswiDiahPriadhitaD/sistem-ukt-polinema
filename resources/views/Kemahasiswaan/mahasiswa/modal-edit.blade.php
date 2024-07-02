<!-- Edit Mahasiswa Modal -->
<div class="modal fade" id="editMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="editMahasiswaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMahasiswaModalLabel">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMahasiswaForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="edit_nama_mahasiswa" name="nama_mahasiswa" placeholder="Masukkan Nama Mahasiswa">
                        <span class="text-danger" id="edit_nama_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_nim_mahasiswa">NIM Mahasiswa</label>
                        <input type="text" class="form-control" id="edit_nim_mahasiswa" name="nim_mahasiswa" placeholder="Masukkan NIM Mahasiswa">
                        <span class="text-danger" id="edit_nim_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_angkatan_mahasiswa">Angkatan Mahasiswa</label>
                        <input type="number" class="form-control" id="edit_angkatan_mahasiswa" name="angkatan_mahasiswa" placeholder="Masukkan Angkatan Mahasiswa">
                        <span class="text-danger" id="edit_angkatan_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_semester_mahasiswa">Semester Mahasiswa</label>
                        <select class="form-control select2" id="edit_semester_mahasiswa" name="semester_mahasiswa">
                            <option value="">Pilih Semester</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                        <span class="text-danger" id="edit_semester_mahasiswa_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_id_program_studi">Program Studi</label>
                        <select class="form-control select2" id="edit_id_program_studi" name="id_program_studi"></select>
                        <span class="text-danger" id="edit_id_program_studi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_id_kelompok_ukt">Kelompok UKT</label>
                        <select class="form-control select2" id="edit_id_kelompok_ukt" name="id_kelompok_ukt"></select>
                        <span class="text-danger" id="edit_id_kelompok_ukt_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_jalur_masuk">Jalur Masuk</label>
                        <select class="form-control select2" name="jalur_masuk" id="edit_jalur_masuk">
                            <option value="" selected disabled>Jalur Masuk</option>
                            <option value="PSB/PMDK/SNMPN/SNMPTN">PSB/PMDK/SNMPN/SNMPTN</option>
                            <option value="UMPN PSDKU">UMPN PSDKU</option>
                            <option value="UMPN/SBMPN/SBMPTN">UMPN/SBMPN/SBMPTN</option>
                            <option value="Mandiri-1">Mandiri-1</option>
                            <option value="Mandiri-2">Mandiri-2</option>
                        </select>
                        <span class="text-danger" id="edit_jalur_masuk_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
