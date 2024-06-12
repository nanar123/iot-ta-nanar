<?php

namespace App\Http\Controllers;

use App\Models\Lamp;
use Illuminate\Http\Request;

class LampController extends Controller
{
    public function index()
    {
        function index(){
            $lamps = Lamp::orderBy('created_at')->get(); // Mengambil data hujan dari model Rain
            $data['lamps'] = $lamps; // Menyiapkan data hujan

            return view('pages.aktu', $data); // Menampilkan view 'pages.rain.index' bersama dengan data hujan
        }
    }
}
