<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){

        $users = User::orderBy('name')->get();
        $data['users'] = $users;
        return view('pages.user.index', $data);
    }
}
