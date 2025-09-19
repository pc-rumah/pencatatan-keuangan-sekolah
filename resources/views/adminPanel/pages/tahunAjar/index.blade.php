@extends('layouts.adminPanel')

@section('title')
    Tahun Ajar
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTaModal">Tambah Baru</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajar</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahunAjar as $item)
                                <tr>
                                    <td>{{ $tahunAjar->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->tahun_ajar }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                            data-bs-target="#editKelasModal{{ $item->id }}"><i
                                                class="fas fa-edit"></i>Edit</button>
                                        {{-- Edit Kelas Modal --}}
                                        <div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Tahun Ajar
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('ta.update', $item->id) }}" method="POST"
                                                            data-parsley-validate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="tahun_ajar"
                                                                    class="col-form-label col-sm-2">Tahun Ajar</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="tahun_ajar" id="tahun_ajar"
                                                                        value="{{ $item->tahun_ajar }}" class="form-control"
                                                                        placeholder="Masukan Tahun AJar"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="start_date"
                                                                    class="col-form-label col-sm-2">Tanggal Mulai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" name="start_date" id="start_date"
                                                                        value="{{ $item->start_date }}" class="form-control"
                                                                        placeholder="Masukan Tahun Ajar"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="end_date"
                                                                    class="col-form-label col-sm-2">Tanggal Selesai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" name="end_date" id="end_date"
                                                                        value="{{ $item->end_date }}" class="form-control"
                                                                        placeholder="Masukan Tahun Ajar"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('ta.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin menghapus data?')">
                                                <i class="fas fa-times"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $tahunAjar->links() }}
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Include kelas modal --}}
    @include('adminPanel.pages.tahunAjar.form')
@endsection
