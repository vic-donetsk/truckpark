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
    public function index()
    {
        return view('main');
    }

    /*
     *  вывод страницы справочника автопарков
     */
    public function show()
    {

        $allParks = Park::with('trucks')->get();

        $allTrucks = Truck::all();

        return view('manager.manager', [
            'parks' => $allParks,
            'headers' => ['name' => 'Название', 'address' => 'Адрес', 'work_schedule' => 'График работы']
        ]);
    }

    /*
     *  вывод формы создания/редактирования парка
     */
    public function edit(Request $request, int $id = null)
    {
        $park = ($id) ? Park::with('trucks')->find($id) : null;

        return view('park_edit.park_edit', [
            'park' => $park,
            'headers' => ['name' => 'Название', 'address' => 'Адрес', 'work_schedule' => 'График работы']
        ]);
    }


    /*
     *  создает новый или обновляет существующий парк
     */
    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|min:2',
            'address' => 'required|min:10',
        ]);


        return redirect(route('park_show'));
    }


    /*
     *  удаление парка из БД
     */
    public function delete(Request $request)
    {
        try {
            $park = Park::find($request->id);
            $park->trucks()->detach();
            $park->delete();
        } catch (\Throwable $e) {
        }

    }
}
