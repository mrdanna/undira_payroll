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
}
