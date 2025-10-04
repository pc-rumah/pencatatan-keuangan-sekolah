@extends('layouts.adminPanel')

@section('title')
    Tagihan
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
                                <th>Jenis</th>
                                <th>Siswa</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan as $item)
                                <tr>
                                    <td>{{ $tagihan->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->jenis->jenis_tagihan }}</td>
                                    <td>{{ $item->siswa->name }}</td>
                                    <td>{{ $item->jenis->nominal }}</td>
                                    @if ($item->status == 'lunas')
                                        <td><span class="badge bg-success">Lunas</span></td>
                                    @else
                                        <td><span class="badge bg-warning">Belum Lunas</span></td>
                                    @endif
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                            data-bs-target="#editKelasModal{{ $item->id }}"><i
                                                class="fas fa-edit"></i>Edit</button>

                                        {{-- Edit Kelas Modal --}}
                                        @include('adminPanel.pages.tagihan.edit')

                                        <form action="{{ route('tagihan.destroy', $item->id) }}" method="POST">
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
                        {{ $tagihan->links() }}
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Include kelas modal --}}
    @include('adminPanel.pages.tagihan.form')
@endsection
