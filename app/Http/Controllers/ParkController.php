<?php

namespace App\Http\Controllers;

use App\Models\Park;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkController extends Controller
{
    /*
     *  вывод страницы главного меню приложения
     */
    public function index() {
        return view('main');
    }

    /*
     *  вывод страницы справочника автопарков
     */
    public function show() {

        $allParks = Park::with('trucks')->get();

        $allTrucks = Truck::all();

        return view('manager.manager', ['parks' => $allParks, 'trucks' => $allTrucks]);
    }

    public function delete(Request $request) {
        try {
            $park = Park::find($request->id);
            $park->trucks()->detach();
            $park->delete();
        }
        catch(\Throwable $e) {
        }

    }
}
