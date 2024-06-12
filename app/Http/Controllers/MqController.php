<?php

namespace App\Http\Controllers;

use App\Models\Mq;
use Illuminate\Http\Request;

class MqController extends Controller
{
    function index(){

        $mqs = Mq::orderBy('value')->get();
        $data['mqs'] = $mqs;
        return view('pages.datasensor', $data);
    }
}
