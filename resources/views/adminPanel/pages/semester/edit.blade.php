<div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Semester
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('semester.update', $item->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label for="tahun_ajar_id" class="col-form-label col-sm-2">Semester</label>
                            <select class="form-select" name="tahun_ajar_id" id="tahun_ajar_id" required>
                                <option>Pilih Tahun Ajar</option>
                                @foreach ($ta as $tahunAjar)
                                    <option value="{{ $tahunAjar->id }}"
                                        {{ $item->tahun_ajar_id == $tahunAjar->id ? 'selected' : '' }}>
                                        {{ $tahunAjar->tahun_ajar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-form-label col-sm-2">Nama
                            Semester</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" value="{{ $item->name }}"
                                class="form-control" placeholder="Masukan Nama Semester" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="start_date" class="col-form-label col-sm-2">Tanggal Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date" id="start_date"
                                value="{{ $item->start_date?->format('Y-m-d') }}" class="form-control"
                                placeholder="Masukan Tanggal" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end_date" class="col-form-label col-sm-2">Tanggal Selesai</label>
                        <div class="col-sm-10">
                            <input type="date" name="end_date" id="end_date"
                                value="{{ $item->end_date?->format('Y-m-d') }}" class="form-control"
                                placeholder="Masukan Tanggal" data-parsley-required="true"
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
