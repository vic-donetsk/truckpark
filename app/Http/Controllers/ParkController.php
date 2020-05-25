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
        // делаем кастомную валидацию. Встроенная не проходит, поскольку
        // при возврате ошибок средствами Ларавел теряются динамически созданные поля
        // с новыми машинами
        $errors = [];
        // проверка полей автопарка
        foreach ($this->headers as $key => $value) {
            if (!$request->$key and $key !== 'work_schedule') {
                $errors[] = [$key, 'Это поле должно быть заполнено!'];
            }
            // проверяем на дубликат названия
            if ($key === 'name' and $request->name) {
                try {
                    $dublicat = Park::where([['name', $request->name], ['id', '<>', $request->id]])->firstOrFail();
                    $errors[] = [$key, 'Автопарк с таким названием уже зарегистрирован'];
                }
                catch (\Throwable $e) {
                }
            }
        }
        // проверка полей добавленных машин
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
        // возврат ошибок валидации
        if ($errors) return response()->json($errors);

        // сохранение/добавление автопарка

        // находим или создаём автопарк
        $park = ($request->id) ? Park::find($request->id) : new Park;

        // вначале сохраняем данные самого автопарка
        foreach ($this->headers as $header => $value) {
            $park->{$header} = $request->{$header};
        }
        $park->save();

        // затем делаем привязку машин к автопарку
        $newTrucks = [];
        if ($request->newTruckIds) {
            foreach ($request->newTruckIds as $key => $id) {
                if ($id) {
                    $newTrucks[] = $id;
                } else {
                    // создаём новую машину в БД
                    $truck = new Truck();
                    $truck->name = $request->newTruckNames[$key];
                    $truck->driver = $request->newTruckDrivers[$key];
                    $truck->user_id = Auth::id();
                    $truck->save();
                    $newTrucks[] = $truck->id;
                }
            }
        }
        $park->trucks()->sync(array_merge($request->oldTruckIds, $newTrucks));

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
