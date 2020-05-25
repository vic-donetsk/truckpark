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

        $parks = Park::all();

        if ($id) {
            $truck = Truck::with('parks')->find($id);
            $free_parks = $parks->diff($truck->parks)->pluck('name','id');
        } else {
            $truck = null;
            $free_parks = $parks->pluck('name','id');
        }

        return view('truck_edit.truck_edit', [
            'truck' => $truck,
            'headers' => $this->headers,
            'freeParks' => $free_parks
        ]);
    }

    /*
     *  создает новый или обновляет существующий парк
     */
    public function update(Request $request)
    {
        // делаем кастомную валидацию. Встроенная не проходит, поскольку
        // при возврате ошибок средствами Ларавел теряются динамически созданные поля
        // с новыми привязанными парками
        $errors = [];
        // проверка свойств автомобиля
        foreach ($this->headers as $key => $value) {
            // проверяем, чтобы было заполнено
            if (!$request->$key) {
                $errors[] = [$key, 'Это поле должно быть заполнено!'];
            }
            // проверяем на дубликат госномера
            if ($key === 'name' and $request->name) {
                try {
                    $dublicat = Truck::where([['name', $request->name], ['id', '<>', $request->id]])->firstOrFail();
                    $errors[] = [$key, 'Автомобиль с таким номером уже есть в базе!'];
                }
                catch (\Throwable $e) {
                }
            }
        }
        // возврат ошибок валидации
        if ($errors) return response()->json($errors);

        // сохранение/добавление автомобиля

        // находим или создаём машину
        $truck = ($request->id) ? Truck::find($request->id) : new Truck;

        // вначале сохраняем данные самого автопарка
        foreach ($this->headers as $header => $value) {
            $truck->{$header} = $request->{$header};
        }
        $truck->user_id = Auth::id();
        $truck->save();

        // затем делаем привязку машин к автопарку
        $truck->parks()->sync($request->newParkIds);

        return 'ok';
    }

    /*
     *  удаление автомобиля из БД
     */
    public function delete(Request $request)
    {
        try {
            $truck = Truck::find($request->id);
            $truck->parks()->detach();
            $truck->delete();
        } catch (\Throwable $e) {
        }

    }
}
