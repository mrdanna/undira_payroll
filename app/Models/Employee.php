<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_emp'; // pakai id_emp sebagai PK
    public $incrementing = true; // tetap auto increment
    protected $fillable = ['jabatan_id', 'nama', 'email', 'alamat'];
}
