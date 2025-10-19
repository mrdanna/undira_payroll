@extends('backend.dashboard.index')

@section('title', 'Data Pegawai')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Data Pegawai</h4>
    <a href="{{ route('emp_create') }}" class="btn btn-primary btn-sm">+ Tambah Pegawai</a>
</div>

{{-- Pesan Sukses --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Jabatan</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($emp as $p)
                <tr>
                    <td>{{ $p->id_emp }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->jabatan_id }}</td>
                    <td>

                        <a href="{{ route('emp_edit', $p->id_emp) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('emp_delete', $p->id_emp) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pegawai</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
