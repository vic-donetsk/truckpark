<?php

namespace App\Http\Controllers;

use App\Models\Park;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkController extends Controller
{
    // заголовки выводимых таблиц
    protected $headers = ['name' => 'Название', 'address' => 'Адрес', 'work_schedule' => 'График работы'];

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
            'headers' => $this->headers
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
            'headers' => $this->headers
        ]);
    }


    /*
     *  создает новый или обновляет существующий парк
     */
    public function update(Request $request)
    {
        // делаем кастомную валидациюю Встроенная не проходит, поскольку
        // при возврате ошибок средствами Ларавел теряются динамически созданные поля
        // с новыми машинами
        $errors = [];
        foreach ($this->headers as $key => $value) {
            if (!$request->$key and $key !== 'work_schedule') {
                $errors[] = [$key, 'Это поле должно быть заполнено!'];
            }
        }

        if ($request->has('newTruckNames')) {
            for ($i = 0; $i < count($request->newTruckNames); $i++) {
                if (!$request->newTruckNames[$i]) {
                    $errors[] = ['truck_'.$i, 'Это поле должно быть заполнено!'];
                }
            }
            for ($i = 0; $i < count($request->newTruckDrivers); $i++) {
                if (!$request->newTruckDrivers[$i]) {
                    $errors[] = ['driver_'.$i, 'Это поле должно быть заполнено!'];
                }
            }
        }

        if ($errors) return response()->json($errors);

        dd($request->all());

//        $validatedData = $request->validate([
//            'name' => 'required|min:2',
//            'address' => 'required|min:10',
//            'trucks.*.*' => 'required|max:50'
//        ]);

//        if ($request->has('trucks')) {
//            $array = $request->trucks;
//
//            foreach (array_keys($array) as $fieldKey) {
//                foreach ($array[$fieldKey] as $key => $value) {
//                    $newArray[$key][$fieldKey] = $value;
//                }
//            }
//        }


        return 'ok';
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
