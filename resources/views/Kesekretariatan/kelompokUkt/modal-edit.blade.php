<div class="modal fade" id="editKelompokUktModal" tabindex="-1" role="dialog" aria-labelledby="editKelompokUktModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKelompokUktModalLabel">Edit Kelompok Ukt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editKelompokUktForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_id_program_studi">Program Studi</label>
                        <select class="form-control select2" id="edit_id_program_studi" name="id_program_studi">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                        <span class="text-danger" id="edit_id_program_studi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelompok_ukt">Nama Kelompok Ukt</label>
                        <input type="text" class="form-control" id="edit_nama_kelompok_ukt" name="nama_kelompok_ukt"
                            placeholder="Masukkan Nama Kelompok Ukt">
                        <span class="text-danger" id="edit_nama_kelompok_ukt_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="nominal_kelompok_ukt">Nominal Kelompok Ukt</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control" id="edit_nominal_kelompok_ukt"
                                name="nominal_kelompok_ukt" placeholder="Masukkan Nominal Kelompok Ukt">
                        </div>
                        <span class="text-danger" id="edit_nominal_kelompok_ukt_error"></span>
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
