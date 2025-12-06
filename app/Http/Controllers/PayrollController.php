<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\PayrollDetail;

class PayrollController extends Controller
{
    public function index(){
        $emp = Employee::with('position')->get();
        return view ('backend.payroll.index', compact('emp'));
    }

    public function create($id)
    {
        $emp = Employee::with('position')->findOrFail($id);
        return view('backend.payroll.create', compact('emp'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'emp_id' => 'required',
            'bulan' => 'required',
            'total_gaji' => 'required',
            'jenis' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        // 2. Simpan ke tabel payrolls
        $payroll = Payroll::create([
            'id_emp'     => $request->emp_id,
            'bulan'      => $request->bulan,
            'total_gaji' => $request->total_gaji,
        ]);

        // 3. Simpan ke payroll_details
        foreach ($request->jenis as $i => $jenis) {
            PayrollDetail::create([
                'payroll_id' => $payroll->id,
                'jenis'      => $jenis,
                'keterangan' => $request->keterangan[$i] ?? null,
                'jumlah'     => $request->jumlah[$i],
            ]);
        }

        return redirect()->route('payroll')
                         ->with('success', 'Payroll berhasil dibuat!');
    }

    public function showByEmployee($id)
    {
        $employee = Employee::with('position')->findOrFail($id);

        $payrolls = Payroll::where('id_emp', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('backend.payroll.show', compact('employee', 'payrolls'));
    }

    public function showDetail($id)
    {
        // Ambil payroll + relasi pegawai + detail payroll + jabatan
        $payroll = Payroll::with([
            'employee.position',
            'details'
        ])->findOrFail($id);

        return view('backend.payroll.detail', compact('payroll'));
    }

     public function edit($id)
    {
        $payroll = Payroll::with('details', 'employee.position')->findOrFail($id);

        return view('backend.payroll.edit', compact('payroll'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bulan' => 'required',
            'total_gaji' => 'required',
            'jenis' => 'required|array',
            'jumlah' => 'required|array'
        ]);

        $payroll = Payroll::findOrFail($id);

        // Update payroll
        $payroll->update([
            'bulan' => $request->bulan,
            'total_gaji' => $request->total_gaji
        ]);

        // Hapus semua detail lama
        PayrollDetail::where('payroll_id', $id)->delete();

        // Input ulang detail
        foreach ($request->jenis as $i => $jenis) {
            PayrollDetail::create([
                'payroll_id' => $id,
                'jenis' => $jenis,
                'keterangan' => $request->keterangan[$i] ?? null,
                'jumlah' => $request->jumlah[$i]
            ]);
        }

        return back()->with('success', 'Payroll berhasil diperbarui!');
    }

     public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);

        // Hapus detail terlebih dahulu
        PayrollDetail::where('payroll_id', $id)->delete();

        // Hapus payroll utama
        $payroll->delete();

        return back()->with('success', 'Payroll berhasil dihapus!');
    }

}
