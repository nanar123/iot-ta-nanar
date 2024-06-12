<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rain extends Model
{
    use HasFactory;
    protected $table = 'rains'; // Pastikan ini mengarah ke 'rains'

    protected $fillable = ['value', 'weather', 'created_at'];
}
