<?php

namespace App\Http\Controllers;

use App\Models\Buzzer;
use App\Models\Lamp;
use Illuminate\Http\Request;

class AktuController extends Controller
{
    public function index()
    {
        $lamps = Lamp::orderBy('created_at')->get();
        $buzzers = Buzzer::orderBy('created_at')->get();

        return view('pages.aktu', compact('lamps', 'buzzers' ));
    }
}
