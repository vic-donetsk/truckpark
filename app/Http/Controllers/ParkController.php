<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkController extends Controller
{
    public function index() {
//        $user = Auth::user();
//        dd($user->role);
        return view('welcome');
    }
}
