<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
     protected $fillable = [
        'id_emp',
        'bulan',
        'total_gaji'
    ];

    public function details()
    {
        return $this->hasMany(PayrollDetail::class, 'payroll_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_emp', 'id_emp');
    }
}
