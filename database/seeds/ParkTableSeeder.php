<?php

use Illuminate\Database\Seeder;
use App\Models\Park;

class ParkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $word = ' автопарк';
        $parks = [
            ['name' =>'Нулевой', 'address' => 'Николая II, 0', 'work_schedule' => 'как царь-батюшка прикажет'],
            ['name' =>'Первый', 'address' => 'Ленина, 1', 'work_schedule' => 'с утра до вечера'],
            ['name' =>'Второй', 'address' => 'Сталина, 2', 'work_schedule' => 'по настроению'],
            ['name' =>'Третий', 'address' => 'Хрущёва, 3', 'work_schedule' => 'весело, задорно и с энтузиазмом'],
            ['name' =>'Четвертый', 'address' => 'Брежнева, 4', 'work_schedule' => 'в будние дни'],
            ['name' =>'Пятый', 'address' => 'Андропова, 5', 'work_schedule' => 'круглосуточно 24/7'],
            ['name' =>'Шестой', 'address' => 'Черненко, 6', 'work_schedule' => 'без отдыха и перекуров'],
            ['name' =>'Седьмой', 'address' => 'Горбачева, 7', 'work_schedule' => 'только в ночную смену'],
            ['name' =>'Восьмой', 'address' => 'Кравчука, 8', 'work_schedule' => 'до последнего клиента'],
            ['name' =>'Девятый', 'address' => 'Кучмы, 9', 'work_schedule' => ''],
            ['name' =>'Десятый', 'address' => 'Ющенко, 10', 'work_schedule' => 'как пчелки. Но безрезультатно'],
            ['name' =>'11-й', 'address' => 'Януковича, 11', 'work_schedule' => 'с 8 до 17, сб,вс - выходные'],
            ['name' =>'12-й', 'address' => 'Порошенко, 12', 'work_schedule' => 'по выходным, пн-пт - отдыхаем'],
            ['name' =>'13-й', 'address' => 'Зеленского, 13', 'work_schedule' => 'изредка, и вообще непонятно, зачем работаем'],
        ];

        foreach ($parks as $park) {
            Park::create([
                'name' => $park['name'] . $word,
                'address' => 'г.Харьков, ул.' . $park['address'],
                'work_schedule' => $park['work_schedule'] ? 'Работаем ' . $park['work_schedule'] : ''
            ]);

        }
    }
}
