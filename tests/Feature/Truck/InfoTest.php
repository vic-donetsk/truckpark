<?php

namespace Tests\Feature\Truck;

use App\Http\Controllers\TruckController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class InfoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест функции проверки наличия машины в базе по номеру
     * TruckController->info();
     *
     * @dataProvider correctProvider
     *
     * @return void
     */
    public function testTruckExsists($name, $driver)
    {
        $this->seed(\RolesTableSeeder::class);
        $this->seed(\UserTableSeeder::class);
        $this->seed(\ParkTableSeeder::class);
        $this->seed(\TruckTableSeeder::class);

        $controller = new TruckController();
        $request = new Request(['name' => $name]);
        // делаем запрос в БД
        $response = $controller->info($request)->getContent();
        // получаем в ответ json
        $this->assertJson($response);
        // и имя водителя соответствует тестовому значению
        $this->assertEquals(json_decode($response)->driver, $driver);
    }

    /**
     * Провайдер записанных сидами номеров
     * @return array
     */
    public function correctProvider()
    {
        return [
            ['AX1111AX', 'Петров Петр'],
            ['ax2222ax', 'Сидоров Сидор'],
            ['ax3333ax', 'Сергеев Сергей'],
            ['ax4444ax', 'Алексеев Алексей'],
            ['АX5555AX', 'Игорев Игорь'],
        ];
    }

    /**
     * Тест функции проверки наличия машины в базе по номеру
     * TruckController->info();
     *
     * @dataProvider wrongProvider
     *
     * @return void
     */
    public function testTruckAbsent($name)
    {
        $this->seed(\RolesTableSeeder::class);
        $this->seed(\UserTableSeeder::class);
        $this->seed(\ParkTableSeeder::class);
        $this->seed(\TruckTableSeeder::class);

        $controller = new TruckController();
        $request = new Request(['name' => $name]);
        // делаем запрос в БД
        $response = $controller->info($request);
        // получаем в ответ null
        $this->assertNull($response);
    }




    /**
     * Провайдер отсуствующих в базе номеров
     * @return array
     */
    public function wrongProvider()
    {
        return [
            ['AH1111AH'],
            ['ah1111ah'],
            ['АН1111АН'],
            ['ан1111ан'],
            ['AX1111AX1'],
        ];
    }


}
