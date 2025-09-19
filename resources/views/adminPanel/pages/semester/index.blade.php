@extends('layouts.adminPanel')

@section('title')
    Semester
@endsection

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSemesterModal">Tambah
                    Baru</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajar</th>
                                <th>Nama Semester</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semester as $item)
                                <tr>
                                    <td>{{ $semester->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->tahunAjar->tahun_ajar }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->start_date?->format('d-m-Y') }}</td>
                                    <td>{{ $item->end_date?->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
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
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Semester
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('semester.update', $item->id) }}"
                                                            method="POST" data-parsley-validate>
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group row">
                                                                <div class="input-group mb-3">
                                                                    <label for="tahun_ajar_id"
                                                                        class="col-form-label col-sm-2">Semester</label>
                                                                    <select class="form-select" name="tahun_ajar_id"
                                                                        id="tahun_ajar_id" required>
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
                                                                    <input type="text" name="name" id="name"
                                                                        value="{{ $item->name }}" class="form-control"
                                                                        placeholder="Masukan Nama Semester"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Bidang ini wajib di isi!"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="start_date"
                                                                    class="col-form-label col-sm-2">Tanggal Mulai</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" name="start_date" id="start_date"
                                                                        value="{{ $item->start_date?->format('Y-m-d') }}"
                                                                        class="form-control" placeholder="Masukan Tanggal"
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
                                                                        value="{{ $item->end_date?->format('Y-m-d') }}"
                                                                        class="form-control" placeholder="Masukan Tanggal"
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
                </div>

                <form action="{{ route('semester.destroy', $item->id) }}" method="POST">
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
                {{ $semester->links() }}
                </table>
            </div>
        </div>
        </div>
    </section>

    {{-- Include kelas modal --}}
    @include('adminPanel.pages.semester.form')
@endsection
