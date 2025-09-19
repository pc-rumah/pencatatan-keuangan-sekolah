<div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Tahun Ajar
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ta.update', $item->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="tahun_ajar" class="col-form-label col-sm-2">Tahun Ajar</label>
                        <div class="col-sm-10">
                            <input type="text" name="tahun_ajar" id="tahun_ajar" value="{{ $item->tahun_ajar }}"
                                class="form-control" placeholder="Masukan Tahun AJar" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-form-label col-sm-2">Tanggal Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date" id="start_date" value="{{ $item->start_date }}"
                                class="form-control" placeholder="Masukan Tahun Ajar" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_date" class="col-form-label col-sm-2">Tanggal Selesai</label>
                        <div class="col-sm-10">
                            <input type="date" name="end_date" id="end_date" value="{{ $item->end_date }}"
                                class="form-control" placeholder="Masukan Tahun Ajar" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
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
