@extends('layouts.adminPanel')

@section('title')
    Siswa
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
                                <th>Nik</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Gender</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $item)
                                <tr>
                                    <td>{{ $siswa->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                            data-bs-target="#editKelasModal{{ $item->id }}"><i
                                                class="fas fa-edit"></i>Edit</button>

                                        {{-- Edit Kelas Modal --}}
                                        @include('adminPanel.pages.siswa.edit')

                                        <form action="{{ route('siswa.destroy', $item->id) }}" method="POST">
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
                        {{ $siswa->links() }}
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Include kelas modal --}}
    @include('adminPanel.pages.siswa.form')
@endsection
