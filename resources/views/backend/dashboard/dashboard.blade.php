@extends('backend.dashboard.index')
@section('title', 'Dashboard')
@section('content')

<h3 class="fw-bold mb-4">Dashboard</h3>

<div class="row g-3">

    {{-- CARD TOTAL KARYAWAN --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body bg-primary text-white rounded-3 p-4">
                <h6 class="fw-semibold mb-1">Total Karyawan</h6>
                <h2 class="fw-bold mb-1">{{ $totalKaryawan }}</h2>
                <small>Jumlah seluruh karyawan aktif</small>
            </div>
        </div>
    </div>

    {{-- CARD TOTAL PAYROLL BULAN INI --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body bg-success text-white rounded-3 p-4">
                <h6 class="fw-semibold mb-1">Payroll Bulan Ini</h6>
                <h2 class="fw-bold mb-1">
                    Rp {{ number_format($totalPayrollBulanIni, 0, ',', '.') }}
                </h2>
                <small>Total gaji dibayarkan bulan ini</small>
            </div>
        </div>
    </div>

    {{-- CARD TOTAL JABATAN --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body bg-secondary text-white rounded-3 p-4">
                <h6 class="fw-semibold mb-1">Total Jabatan</h6>
                <h2 class="fw-bold mb-1">{{ $totalJabatan }}</h2>
                <small>Jumlah jabatan yang tersedia</small>
            </div>
        </div>
    </div>

</div>

@endsection
