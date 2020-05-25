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
            ['name' =>'Первый', 'address' => 'Кравчука, 8', 'work_schedule' => 'с 8 до 17, сб,вс - выходные'],
            ['name' =>'Второй', 'address' => 'Кучмы, 9', 'work_schedule' => 'круглосуточно, без сна и перекуров'],
            ['name' =>'Третий', 'address' => 'Ющенко, 10', 'work_schedule' => 'как пчелки. Но без вдохновения'],
            ['name' =>'Четвертый', 'address' => 'Януковича, 11', 'work_schedule' => 'по выходным с 8 до 17, пн-пт - отдыхаем'],
            ['name' =>'Пятый', 'address' => 'Порошенко, 12', 'work_schedule' => 'изредка. Все уехали в Польшу'],
            ['name' =>'Шестой', 'address' => 'Зеленского, 13', 'work_schedule' => 'на удаленке. КОРОНАВИРУС!!!'],
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
