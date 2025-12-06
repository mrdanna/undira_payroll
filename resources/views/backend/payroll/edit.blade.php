@extends('backend.dashboard.index')

@section('title', 'Edit Payroll')

@section('content')

<h4 class="fw-bold mb-3">Edit Payroll - {{ $payroll->employee->nama }}</h4>

<form action="{{ route('payroll_update', $payroll->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="emp_id" value="{{ $payroll->employee->id_emp }}">

    <div class="row">
        <div class="col-md-6">

            <div class="mb-3">
                <label class="form-label">Periode / Bulan</label>
                <input type="month" name="bulan" class="form-control" value="{{ $payroll->bulan }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>

                <input type="text" id="gaji_pokok_display"
                    value="{{ number_format($payroll->employee->position->gaji_pokok,0,',','.') }}"
                    class="form-control" disabled>

                <input type="hidden" id="gaji_pokok" value="{{ $payroll->employee->position->gaji_pokok }}">
            </div>

        </div>
    </div>

    <hr>

    <h5 class="fw-bold">Detail Payroll</h5>

    <table class="table table-bordered" id="detail-table">
        <thead class="table-light">
            <tr>
                <th width="25%">Jenis</th>
                <th width="45%">Keterangan</th>
                <th width="20%">Jumlah</th>
                <th width="10%">#</th>
            </tr>
        </thead>

        <tbody>
            @foreach($payroll->details as $d)
            <tr>
                <td>
                    <select name="jenis[]" class="form-control jenis" required>
                        <option value="">-- Pilih --</option>
                        <option value="Tunjangan" {{ $d->jenis == 'Tunjangan' ? 'selected' : '' }}>Tunjangan</option>
                        <option value="Potongan" {{ $d->jenis == 'Potongan' ? 'selected' : '' }}>Potongan</option>
                        <option value="Lembur" {{ $d->jenis == 'Lembur' ? 'selected' : '' }}>Lembur</option>
                        <option value="Lainnya" {{ $d->jenis == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </td>

                <td><input type="text" name="keterangan[]" class="form-control" value="{{ $d->keterangan }}"></td>

                <td><input type="number" name="jumlah[]" class="form-control jumlah" value="{{ $d->jumlah }}" required></td>

                <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn btn-secondary btn-sm mb-3" id="add-row">
        + Tambah Detail
    </button>

    <hr>

    <h4>Total Gaji:
        <span id="total_display" class="fw-bold text-success">
            Rp {{ number_format($payroll->total_gaji,0,',','.') }}
        </span>
    </h4>

    <input type="hidden" name="total_gaji" id="total_gaji" value="{{ $payroll->total_gaji }}">

    <br>

    <button class="btn btn-primary">Update Payroll</button>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
</form>

<script>
function hitungTotal() {
    let gaji_pokok = parseInt(document.getElementById('gaji_pokok').value);
    let rows = document.querySelectorAll('#detail-table tbody tr');

    let tambahan = 0;
    let potongan = 0;

    rows.forEach(row => {
        let jenis = row.querySelector('.jenis').value;
        let jumlah = parseInt(row.querySelector('.jumlah').value || 0);

        if (jenis == 'Tunjangan' || jenis == 'Lembur') {
            tambahan += jumlah;
        }
        if (jenis == 'Potongan') {
            potongan += jumlah;
        }
    });

    let total = gaji_pokok + tambahan - potongan;

    document.getElementById('total_display').innerHTML =
        "Rp " + total.toLocaleString('id-ID');

    document.getElementById('total_gaji').value = total;
}

document.getElementById('add-row').addEventListener('click', function () {
    let table = document.querySelector('#detail-table tbody');

    let row = `
        <tr>
            <td>
                <select name="jenis[]" class="form-control jenis" required>
                    <option value="">-- Pilih --</option>
                    <option value="Tunjangan">Tunjangan</option>
                    <option value="Potongan">Potongan</option>
                    <option value="Lembur">Lembur</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </td>
            <td><input type="text" name="keterangan[]" class="form-control"></td>
            <td><input type="number" name="jumlah[]" class="form-control jumlah" required></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
        </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);
});

document.addEventListener('input', function () {
    hitungTotal();
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('tr').remove();
        hitungTotal();
    }
});

// Hitung total saat halaman dibuka
hitungTotal();
</script>

@endsection
