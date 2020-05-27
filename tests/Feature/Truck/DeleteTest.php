<?php

namespace Tests\Feature\Truck;

use App\Http\Controllers\TruckController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

use App\Models\Truck;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест функции удаления машины из базы
     * TruckController->delete();
     *
     * @return void
     */
    public function testTruckDelete()
    {
        $this->seed(\RolesTableSeeder::class);
        $this->seed(\UserTableSeeder::class);

        // создаем тестовую машину
        $truck = factory(Truck::class)->create();

        // проверяем ее создание
        $this->assertDatabaseHas('trucks', ['id' => $truck->id]);

        // создаём тестовый request
        $request = new Request(['id' => $truck->id]);

        // запускаме функцию напрямую через контроллер, а не через роут,
        // поскольку здесь проверяем именно удаление, а не работу
        // авторизационного middleware
        $controller = new TruckController();
        $controller->delete($request);
        // проверяем удаление
        $this->assertDeleted('trucks', ['id' => $truck->id]);
    }


}
