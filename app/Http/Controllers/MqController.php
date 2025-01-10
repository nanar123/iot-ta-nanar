<?php

namespace App\Http\Controllers;

use App\Models\Mq;
use Illuminate\Http\Request;

class MqController extends Controller
{
    public function index()
    {
        $mqs = Mq::orderBy('created_at', 'desc')->get(); // Urutkan data terbaru ke terlama
        return view('pages.datasensor.datamq', compact('mqs'));
    }

}
