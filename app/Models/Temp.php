<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    use HasFactory;
    protected $table = 'temps'; // Pastikan ini mengarah ke 'rains'

    protected $fillable = ['temperature', 'humidity', 'created_at'];
}
