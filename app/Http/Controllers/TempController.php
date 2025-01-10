<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use Illuminate\Http\Request;

class TempController extends Controller
{
    public function index()
    {
        $temps = Temp::orderBy('created_at', 'desc')->get(); // Urutkan data terbaru ke terlama
        return view('pages.datasensor.datatemp', compact('temps'));
    }
}
