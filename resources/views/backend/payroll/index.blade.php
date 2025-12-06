@extends('backend.dashboard.index')

@section('title', 'Payroll')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Data Payroll</h4>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Pegawai</th>
                    <th>Jabatan</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach($emp as $e)
                <tr>
                    <td>{{ $e->nama }}</td>
                    <td>{{ $e->position->nama_jabatan ?? '-' }}</td>
                    <td>
                        {{-- Buat payroll baru --}}
                        <a href="{{ route('payroll_create', $e->id_emp) }}"
                           class="btn btn-success btn-sm">
                            + Buat Payroll
                        </a>

                        {{-- Lihat daftar payroll pegawai --}}
                        <a href="{{ route('payroll_show', $e->id_emp) }}"
                           class="btn btn-primary btn-sm">
                            Lihat Payroll
                        </a>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
