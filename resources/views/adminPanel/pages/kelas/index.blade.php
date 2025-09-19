@extends('layouts.adminPanel')

@section('title')
    Kelas
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">Tambah Baru</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Tgl Ditambahkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                                <tr>
                                    <td>{{ $kelas->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
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
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('kelas.update', $item->id) }}" method="POST"
                                                            data-parsley-validate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="nama_kelas" class="col-form-label col-sm-2">Nama
                                                                    Kelas</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="nama_kelas" id="nama_kelas"
                                                                        value="{{ $item->nama_kelas }}" class="form-control"
                                                                        placeholder="Masukan Nama Kelas"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!">
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

                                        <form action="{{ route('kelas.destroy', $item->id) }}" method="POST">
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
                        {{ $kelas->links() }}
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Include kelas modal --}}
    @include('adminPanel.pages.kelas.form')
@endsection
