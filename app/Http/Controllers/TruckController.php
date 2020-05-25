<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Park;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TruckController extends Controller
{
    protected $headers = ['name' => 'Госномер', 'driver' => 'Водитель'];

    /*
     *  страница водителя - работа со своими машинами
     */
    public function show() {

        $trucks = Truck::with('parks')->where('user_id', Auth::id())->get();

        return view('driver.driver', [ 'trucks' => $trucks, 'headers' => $this->headers]);
    }

    /*
     * страница менеджера - просмотр полного справочника автомобилей
     */
    public function index() {

    }

    /*
     * проверка наличия номера автомобиля в базе данных
     */
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

    /*
     * создание/редактирование автомобиля
     */
    public function edit(Request $request, int $id = null) {
        $truck = ($id) ? Truck::with('parks')->find($id) : null;

        $parks = Park::all();

        $diff = $parks->diff($truck->parks);

//        dd(count($parks),count($truck->parks),count($diff));

        return view('truck_edit.truck_edit', [
            'truck' => $truck,
            'headers' => $this->headers
        ]);
    }
}
