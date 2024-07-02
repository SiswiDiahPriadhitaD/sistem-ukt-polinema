<div class="modal fade" id="createPeriodeModal" tabindex="-1" role="dialog" aria-labelledby="createPeriodeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPeriodeModalLabel">Tambah Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createPeriodeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_periode">Nama Periode</label>
                        <input type="text" class="form-control" id="nama_periode" name="nama_periode"
                            placeholder="Masukkan Nama Periode">
                        <span class="text-danger" id="create_nama_periode_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="status_periode">Status Periode</label>
                        <select class="form-control select2" id="status_periode" name="status_periode">
                            <option value="">Pilih Status Periode</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <span class="text-danger" id="create_status_periode_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai_periode">Tanggal Mulai</label>
                        <input type="datetime-local" class="form-control" id="tanggal_mulai_periode"
                            name="tanggal_mulai_periode">
                        <span class="text-danger" id="create_tanggal_mulai_periode_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akhir_periode">Tanggal Selesai</label>
                        <input type="datetime-local" class="form-control" id="tanggal_akhir_periode"
                            name="tanggal_akhir_periode">
                        <span class="text-danger" id="create_tanggal_akhir_periode_error"></span>
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
