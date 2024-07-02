<div class="modal fade" id="editProgramStudiModal" tabindex="-1" role="dialog" aria-labelledby="editProgramStudiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProgramStudiModalLabel">Edit Program Studi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProgramStudiForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_id_jurusan">Jurusan</label>
                        <select class="form-control select2" id="edit_id_jurusan" name="id_jurusan">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                        <span class="text-danger" id="edit_id_jurusan_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_program_studi">Nama Program Studi</label>
                        <input type="text" class="form-control" id="edit_nama_program_studi"
                            name="nama_program_studi" placeholder="Masukkan Nama Program Studi">
                        <span class="text-danger" id="edit_nama_program_studi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_jenjang_pendidikan">Jenjang Pendidikan</label>
                        <select class="form-control select2" id="edit_jenjang_pendidikan" name="jenjang_pendidikan">
                            <option value="D-II">D2</option>
                            <option value="D-III">D3</option>
                            <option value="D-IV">D4</option>
                        </select>
                        <span class="text-danger" id="edit_jenjang_pendidikan_error"></span>
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
