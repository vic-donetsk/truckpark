<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TruckController extends Controller
{
    public function show() {

        if (Gate::allows('all-parks')) {

        }
        return view('driver.driver');
    }

    public function info(Request $request) {
        if ($request->has('name')) {
            try {
                $truck = Truck::where('name', $request->name)->firstOrFail();
                return response()->json(['id' => $truck->id, 'driver' => $truck->driver]);
            }
            catch (\Throwable $e) {
                return null;
            }
        }

    }
}
