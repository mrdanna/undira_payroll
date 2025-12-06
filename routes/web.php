<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PayrollDetailController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login_process');
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/employee', [EmployeeController::class, 'index'])->name('emp');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('emp_create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('emp_store');
Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('emp_delete');
Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('emp_edit');
Route::put('/employee/update/{id}', [EmployeeController::class, 'update'])->name('emp_update');

//jabatan
Route::get('/position', [PositionController::class, 'index'])->name('position');
Route::get('/position/create', [PositionController::class, 'create'])->name('position_create');
Route::post('/position/store', [PositionController::class, 'store'])->name('position_store');
Route::delete('/position/delete/{id}', [PositionController::class, 'delete'])->name('position_delete');
Route::get('/position/edit/{id}', [PositionController::class, 'edit'])->name('position_edit');
Route::put('/position/update/{id}', [PositionController::class, 'update'])->name('position_update');

// PAYROLL
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll');
Route::get('/payroll/create/{id}', [PayrollController::class, 'create'])->name('payroll_create');
Route::post('/payroll/store', [PayrollController::class, 'store'])->name('payroll_store');
Route::get('/payroll/employee/{id}', [PayrollController::class, 'showByEmployee'])->name('payroll_show');
Route::get('/payroll/detail/{id}', [PayrollController::class, 'showDetail'])->name('payroll_detail');
Route::get('/payroll/detail/{id}', [PayrollController::class, 'showDetail'])->name('payroll_detail');

Route::get('/payroll/edit/{id}', [PayrollController::class, 'edit'])->name('payroll_edit');
Route::put('/payroll/update/{id}', [PayrollController::class, 'update'])->name('payroll_update');
Route::delete('/payroll/delete/{id}', [PayrollController::class, 'destroy'])->name('payroll_delete');


// PAYROLL DETAIL
Route::post('/payroll_detail/store', [PayrollDetailController::class, 'store'])->name('payroll_detail_store');
Route::put('/payroll_detail/update/{id}', [PayrollDetailController::class, 'update'])->name('payroll_detail_update');
Route::delete('/payroll_detail/delete/{id}', [PayrollDetailController::class, 'delete'])->name('payroll_detail_delete');
