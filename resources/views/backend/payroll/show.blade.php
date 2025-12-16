@extends('backend.dashboard.index')

@section('title', 'Riwayat Payroll')

@section('content')
<h4 class="fw-bold mb-3">Riwayat Payroll - {{ $employee->nama }}</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>Total Gaji</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payrolls as $p)
                <tr>
                    {{-- Periode payroll diambil dari kolom "bulan" --}}
                    <td>{{ $p->bulan }}</td>

                    {{-- Total gaji --}}
                    <td>Rp {{ number_format($p->total_gaji, 0, ',', '.') }}</td>

                    {{-- Tombol detail --}}
                    <td>
                        <a href="{{ route('payroll_detail', $p->id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>
                        {{-- EDIT --}}
                        <a href="{{ route('payroll_edit', $p->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('payroll_delete', $p->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus payroll ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada payroll</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
