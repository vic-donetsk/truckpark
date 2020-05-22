<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Gate;

class ParkController extends Controller
{
    public function index() {
        return view('main');
    }

    public function show() {

        if (Gate::allows('all-parks')) {

        }
        return view('manager.manager');
    }
}
