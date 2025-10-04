<div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Tagihan
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jenis.update', $item->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="jenis_tagihan" class="col-form-label col-sm-2">Jenis Tagihan</label>
                        <div class="col-sm-10">
                            <input type="text" name="jenis_tagihan" id="jenis_tagihan" class="form-control"
                                placeholder="Masukan Jenis Tagihan" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!"
                                value="{{ $item->jenis_tagihan }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nominal" class="col-form-label col-sm-2">Nominal</label>
                        <div class="col-sm-10">
                            <input type="number" name="nominal" id="nominal" class="form-control"
                                placeholder="Masukan Nominal" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" value="{{ $item->nominal }}"
                                required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
