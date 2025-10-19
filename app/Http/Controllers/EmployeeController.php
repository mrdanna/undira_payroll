<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $emp = Employee::all();
        return view('backend.employees.index', compact('emp'));
    }

     // Form tambah data
    public function create()
    {
        return view('backend.employees.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'alamat' => 'nullable|string',
        ]);

        Employee::create($request->all());

        return redirect()->route('emp')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    // Hapus data
    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('emp')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id . ',id_emp',
            'alamat' => 'nullable|string',
            'jabatan_id' => 'required|string',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jabatan_id' => $request->jabatan_id,
        ]);

        return redirect()->route('emp')->with('success', 'Data pegawai berhasil diperbarui.');
    }
}
