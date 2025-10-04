<div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Tagihan
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tagihan.update', $item->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label for="jenis_id" class="col-form-label col-sm-2">Jenis</label>
                            <select class="form-select" name="jenis_id" id="jenis_id" required>
                                <option value="" disabled selected>Pilih Jenis</option>
                                @foreach ($jenis as $jenisTagihan)
                                    <option value="{{ $jenisTagihan->id }}" @selected(old('jenis_id', $item->jenis_id) == $jenisTagihan->id)>
                                        {{ $jenisTagihan->jenis_tagihan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-group mb-3">
                            <label for="siswa_id" class="col-form-label col-sm-2">Siswa</label>
                            <select class="form-select" name="siswa_id" id="siswa_id" required>
                                <option value="" disabled selected>Pilih Siswa</option>
                                @foreach ($siswa as $namaSiswa)
                                    <option value="{{ $namaSiswa->id }}" @selected(old('siswa_id', $item->siswa_id) == $namaSiswa->id)>
                                        {{ $namaSiswa->name }}</option>
                                @endforeach
                            </select>
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
