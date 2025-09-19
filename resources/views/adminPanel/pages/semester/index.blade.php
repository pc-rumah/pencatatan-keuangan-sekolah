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
                                        @if ($item->is_active == '0')
                                            <form action="{{ route('semester.aktif', $item->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success me-2">
                                                    <i class="fas fa-edit"></i>Aktif
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('semester.nonaktif', $item->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success me-2"><i
                                                        class="fas fa-edit"></i>Nonaktif</button>
                                            </form>
                                        @endif
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                            data-bs-target="#editKelasModal{{ $item->id }}"><i
                                                class="fas fa-edit"></i>Edit</button>

                                        {{-- Edit Kelas Modal --}}
                                        @include('adminPanel.pages.semester.edit')

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
