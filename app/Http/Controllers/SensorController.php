<?php

namespace App\Http\Controllers;

use App\Models\Mq;
use App\Models\Rain;
use App\Models\Temp;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $rains = Rain::orderBy('created_at')->get();
        $temps = Temp::orderBy('created_at')->get();
        $mqs = Mq::orderBy('created_at')->get();

        return view('pages.datasensor', compact('rains', 'temps', 'mqs'));
    }
}
