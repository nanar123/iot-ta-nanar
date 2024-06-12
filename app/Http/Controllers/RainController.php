<?php

namespace App\Http\Controllers;

use App\Models\Rain;
use Illuminate\Http\Request;

class RainController extends Controller
{
    function index(){
        $rains = Rain::orderBy('created_at')->get(); // Mengambil data hujan dari model Rain
        $data['rains'] = $rains; // Menyiapkan data hujan

        return view('pages.datasensor', $data); // Menampilkan view 'pages.rain.index' bersama dengan data hujan
    }
}
