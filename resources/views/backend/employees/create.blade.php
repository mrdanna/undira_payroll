@extends('backend.dashboard.index')

@section('title', 'Input Pegawai')

@section('content')
<div class="container">
    <h2>Tambah Pegawai</h2>
    <form action="{{ route('emp_store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Jabatan ID</label>
            <input type="text" name="jabatan_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('emp') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

