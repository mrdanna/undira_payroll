<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index(){
    //     return view('backend.dashboard.index');
    // }

    public function index()
    {
        // Total karyawan
        $totalKaryawan = Employee::count();

        // Ambil bulan sekarang (format YYYY-MM)
        $bulanIni = date('Y-m');

        // Total payroll bulan ini
        //$totalPayrollBulanIni = Payroll::whereRaw("DATE_FORMAT(bulan, '%Y-%m') = ?", [$bulanIni])
        $totalPayrollBulanIni = Payroll::where('bulan', $bulanIni)
            ->sum('total_gaji');

        // Total jumlah jabatan
        $totalJabatan = Position::count();

        return view('backend.dashboard.dashboard', compact(
            'totalKaryawan',
            'totalPayrollBulanIni',
            'totalJabatan'
        ));
    }
}
