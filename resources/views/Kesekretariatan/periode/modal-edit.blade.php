<div class="modal fade" id="editPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="editPeriodeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPeriodeModalLabel">Edit Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPeriodeForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_nama_periode">Nama Periode</label>
                        <input type="text" class="form-control" id="edit_nama_periode" name="nama_periode"
                            placeholder="Masukkan Nama Periode">
                        <span class="text-danger" id="edit_nama_periode_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_status_periode">Status Periode</label>
                        <select class="form-control select2" id="edit_status_periode" name="status_periode">
                            <option value="">Pilih Status Periode</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <span class="text-danger" id="edit_status_periode_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_mulai_periode">Tanggal Mulai</label>
                        <input type="datetime-local" class="form-control" id="edit_tanggal_mulai_periode"
                            name="tanggal_mulai_periode">
                        <span class="text-danger" id="edit_tanggal_mulai_periode_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_akhir_periode">Tanggal Selesai</label>
                        <input type="datetime-local" class="form-control" id="edit_tanggal_akhir_periode"
                            name="tanggal_akhir_periode">
                        <span class="text-danger" id="edit_tanggal_akhir_periode_error"></span>
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
