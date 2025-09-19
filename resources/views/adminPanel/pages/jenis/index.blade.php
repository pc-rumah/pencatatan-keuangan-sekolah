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
                                        @include('adminPanel.pages.tahunAjar.edit')

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
