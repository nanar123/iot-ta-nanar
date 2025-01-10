<?php

namespace App\Http\Controllers;

use App\Models\Rain;
use Illuminate\Http\Request;

class RainController extends Controller
{
   public function index()
    {
        // Mengambil semua data hujan dan mengurutkannya dari yang terbaru
        $rains = Rain::orderBy('created_at', 'desc')->get();

        // Menghitung jumlah data
        $jumlahData = $rains->count();

        // Mengembalikan view dengan data hujan dan jumlah data
        return view('pages.datasensor.datarain', compact('rains', 'jumlahData'));
    }
}
