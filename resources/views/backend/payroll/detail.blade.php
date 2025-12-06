@extends('backend.dashboard.index')

@section('title', 'Detail Payroll')

@section('content')

@php
    use Carbon\Carbon;
@endphp

<h4 class="fw-bold mb-4">Detail Payroll Pegawai</h4>

{{-- BUTTON PRINT --}}
<div class="mb-3">
    <button class="btn btn-success" onclick="printDiv('area-print')">
        <i class="bi bi-printer"></i> Cetak
    </button>
</div>

{{-- AREA YANG DI-PRINT --}}
<div id="area-print">

    {{-- DATA PEGAWAI --}}
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Data Pegawai</h5>

            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('image/' . $payroll->employee->img) }}"
                        alt="Foto Pegawai"
                        class="img-thumbnail" />
                </div>

                <div class="col-md-9">
                    <p><strong>Nama:</strong> {{ $payroll->employee->nama }}</p>
                    <p><strong>Jabatan:</strong> {{ $payroll->employee->position->nama_jabatan }}</p>
                    <p><strong>Gaji Pokok:</strong>
                        Rp {{ number_format($payroll->employee->position->gaji_pokok, 0, ',', '.') }}
                    </p>
                    <p><strong>Periode:</strong>
                        {{ Carbon::parse($payroll->bulan . '-01')->translatedFormat('F Y') }}
                    </p>
                    <p><strong>Total Gaji:</strong>
                        Rp {{ number_format($payroll->total_gaji, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- DETAIL PAYROLL --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Rincian Payroll</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payroll->details as $d)
                    <tr>
                        <td>{{ $d->jenis }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td>Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada rincian payroll</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div> {{-- END AREA PRINT --}}

{{-- SCRIPT PRINT --}}
<script>
function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    // Reload agar layout kembali normal
    location.reload();
}
</script>

{{-- CSS AGAR BUTTON TIDAK IKUT PRINT --}}
<style>
@media print {
    button, .btn, .navbar, .sidebar {
        display: none !important;
    }
}
</style>

@endsection
