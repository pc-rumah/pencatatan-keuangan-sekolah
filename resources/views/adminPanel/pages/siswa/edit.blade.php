<div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Siswa
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.update', $item->id) }}" method="POST" data-parsley-validate>
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="nik" class="col-form-label col-sm-2">NIK</label>
                        <div class="col-sm-10">
                            <input type="number" name="nik" id="nik" class="form-control"
                                placeholder="Masukan nik" data-parsley-required="true" value="{{ $item->nik }}"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nis" class="col-form-label col-sm-2">NIS</label>
                        <div class="col-sm-10">
                            <input type="number" name="nis" id="nis" class="form-control"
                                value="{{ $item->nis }}" placeholder="Masukan nis" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-form-label col-sm-2">NAMA</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="nama" class="form-control"
                                value="{{ $item->name }}" placeholder="Masukan nama" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="kelas" class="col-form-label col-sm-2">Kelas</label>
                        <select class="form-select" name="kelas_id" id="kelas" required>
                            <option value="" disabled @selected(old('kelas_id', $item->kelas_id) === null)>
                                Pilih Kelas
                            </option>
                            @foreach ($kelas as $data)
                                <option value="{{ $data->id }}" @selected(old('kelas_id', $item->kelas_id) == $data->id)>
                                    {{ $data->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-form-label col-sm-2">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                value="{{ $item->tanggal_lahir?->format('Y-m-d') }}" data-parsley-required="true"
                                data-parsley-required-message="Bidang ini wajib di isi!" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-form-label col-sm-2">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL"
                                    value="L" @checked(old('jenis_kelamin', $item->jenis_kelamin) == 'L') required>
                                <label class="form-check-label" for="jkL">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP"
                                    value="P" @checked(old('jenis_kelamin', $item->jenis_kelamin) == 'P') required>
                                <label class="form-check-label" for="jkP">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $item->alamat }}</textarea>
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
