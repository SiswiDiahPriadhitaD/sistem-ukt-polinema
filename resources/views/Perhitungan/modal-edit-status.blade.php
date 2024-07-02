<!-- Status Verifikasi Modal -->
<div class="modal fade" id="statusVerifikasiModal" tabindex="-1" role="dialog" aria-labelledby="statusVerifikasiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusVerifikasiModalLabel">Ubah Status Verifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusVerifikasiForm">
                <div class="modal-body">
                    <input type="hidden" id="status_mahasiswa_id" name="id">
                    <div class="form-group">
                        <label for="status_verifikasi_perhitungan">Status Verifikasi</label>
                        <select class="form-control select2" id="status_verifikasi_perhitungan"
                            name="status_verifikasi_perhitungan">
                            <option value="Pending">Pending</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Diverifikasi">Diverifikasi</option>
                        </select>
                        <span class="text-danger" id="status_verifikasi_perhitungan_error"></span>
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
