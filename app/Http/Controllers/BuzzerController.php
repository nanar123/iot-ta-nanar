<?php

namespace App\Http\Controllers;

use App\Models\Buzzer;
use Illuminate\Http\Request;

class BuzzerController extends Controller
{
    function index(){
        $buzzers = Buzzer::orderBy('created_at')->get(); // Mengambil data hujan dari model Rain
        $data['buzzers'] = $buzzers; // Menyiapkan data hujan

        return view('pages.aktu', $data); // Menampilkan view 'pages.rain.index' bersama dengan data hujan
    }
}
