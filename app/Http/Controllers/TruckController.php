<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TruckController extends Controller
{
    public function show() {

        if (Gate::allows('all-parks')) {

        }
        return view('driver.driver');
    }
}
