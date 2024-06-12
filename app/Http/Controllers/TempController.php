<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use Illuminate\Http\Request;

class TempController extends Controller
{
    function index(){

        $temps = Temp::orderBy('Humidity')->get();
        $data['temps'] = $temps;
        return view('pages.datasensor', $data);
    }
}
