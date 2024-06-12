<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mq extends Model
{
    use HasFactory;
    protected $table = 'mqs'; // Pastikan ini mengarah ke 'rains'

    protected $fillable = ['value', 'status', ];
}
