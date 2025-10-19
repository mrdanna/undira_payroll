<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

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
