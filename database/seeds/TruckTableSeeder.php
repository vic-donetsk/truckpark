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
          ['name' => 'AX0000AX', 'driver' => 'Иванов Иван', 'user_id' => rand(1, 2)],
          ['name' => 'AX1111AX', 'driver' => 'Петров Петр', 'user_id' => rand(1, 2)],
          ['name' => 'AX2222AX', 'driver' => 'Сидоров Сидор', 'user_id' => rand(1, 2)],
          ['name' => 'AX3333AX', 'driver' => 'Сергеев Сергей', 'user_id' => rand(1, 2)],
          ['name' => 'AX4444AX', 'driver' => 'Алексеев Алексей', 'user_id' => rand(1, 2)],
          ['name' => 'AX5555AX', 'driver' => 'Игорев Игорь', 'user_id' => rand(1, 2)],
          ['name' => 'AX6666AX', 'driver' => 'Матвеев Матвей', 'user_id' => rand(1, 2)],
          ['name' => 'AX7777AX', 'driver' => 'Чингизов Чингиз', 'user_id' => rand(1, 2)],
          ['name' => 'AX8888AX', 'driver' => 'Обоев Рулон', 'user_id' => rand(1, 2)],
          ['name' => 'AX9999AX', 'driver' => 'Помоев Ушат', 'user_id' => rand(1, 2)],
          ['name' => '123-45AX', 'driver' => 'Релизов Бэкап', 'user_id' => rand(1, 2)],
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
