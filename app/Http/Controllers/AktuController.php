<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AktuController extends Controller
{
    function index(){

        return view('pages.aktu');
    }
}
