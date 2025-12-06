<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $emp = Employee::with('position')->get();
        return view('backend.employees.index', compact('emp'));
    }

     // Form tambah data
    public function create()
    {
        $positions = Position::all(); // ambil semua data posisi
        return view('backend.employees.create', compact('positions'));
    }

    // Simpan data baru
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'jabatan_id' => 'required',
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email|unique:employees,email',
    //         'alamat' => 'nullable|string',
    //     ]);

    //     Employee::create($request->all());

    //     return redirect()->route('emp')->with('success', 'Data pegawai berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'jabatan_id' => $request->jabatan_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ];

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $namaFile);

            // Pastikan field di database adalah 'img' atau ubah sesuai field aslinya
            $data['img'] = $namaFile;
        }

        Employee::create($data);

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee = Employee::findOrFail($id);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jabatan_id' => $request->jabatan_id,
        ];

        // Jika ada foto baru diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($employee->img && file_exists(public_path('image/' . $employee->img))) {
                unlink(public_path('image/' . $employee->img));
            }

            // Upload foto baru
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $namaFile);

            $data['img'] = $namaFile; // sesuaikan dengan nama kolom di DB
        }

        $employee->update($data);

        return redirect()->route('emp')->with('success', 'Data pegawai berhasil diperbarui.');
    }
}
