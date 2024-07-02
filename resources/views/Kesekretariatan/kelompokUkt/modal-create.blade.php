<div class="modal fade" id="createKelompokUktModal" tabindex="-1" role="dialog"
    aria-labelledby="createKelompokUktModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKelompokUktModalLabel">Tambah Kelompok Ukt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createKelompokUktForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_program_studi">Jurusan</label>
                        <select class="form-control select2" id="id_program_studi" name="id_program_studi">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                        <span class="text-danger" id="create_id_program_studi_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelompok_ukt">Nama Kelompok Ukt</label>
                        <input type="text" class="form-control" id="nama_kelompok_ukt" name="nama_kelompok_ukt"
                            placeholder="Masukkan Nama Kelompok Ukt">
                        <span class="text-danger" id="create_nama_kelompok_ukt_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="nominal_kelompok_ukt">Nominal Kelompok Ukt</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control" id="nominal_kelompok_ukt"
                                name="nominal_kelompok_ukt" placeholder="Masukkan Nominal Kelompok Ukt">
                        </div>
                        <span class="text-danger" id="create_nominal_kelompok_ukt_error"></span>
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
