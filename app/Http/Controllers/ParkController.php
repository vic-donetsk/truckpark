<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkController extends Controller
{
    public function index() {
        return view('main');
    }

    public function show() {
        return view('manager.manager');
    }
}
