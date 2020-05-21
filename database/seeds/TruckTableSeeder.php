<?php

use Illuminate\Database\Seeder;
use App\Models\Truck;
use App\Models\Park;

class TruckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trucks = [
          ['name' => 'AX0000AX', 'driver' => 'Иванов Иван'],
          ['name' => 'AX1111AX', 'driver' => 'Петров Петр'],
          ['name' => 'AX2222AX', 'driver' => 'Сидоров Сидор'],
          ['name' => 'AX3333AX', 'driver' => 'Сергеев Сергей'],
          ['name' => 'AX4444AX', 'driver' => 'Алексеев Алексей'],
          ['name' => 'AX5555AX', 'driver' => 'Игорев Игорь'],
          ['name' => 'AX6666AX', 'driver' => 'Матвеев Матвей'],
          ['name' => 'AX7777AX', 'driver' => 'Чингизов Чингиз'],
          ['name' => 'AX8888AX', 'driver' => 'Обоев Рулон'],
          ['name' => 'AX9999AX', 'driver' => 'Помоев Ушат'],
          ['name' => '123-45AX', 'driver' => 'Релизов Бэкап'],
        ];

        foreach ($trucks as $truck) {
            $truck = Truck::create($truck);

            $randomParksQuantity = rand(0, 5);
            $randomParks = Park::get()->random($randomParksQuantity);
            $ids = $randomParks->pluck('id')->all();
            $truck->parks()->attach($ids);

        }
    }
}
