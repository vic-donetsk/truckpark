<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

use App\User;

/*
 * проверка авторизации доступа ко всем driver-routes проекта
 */
class DriverTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /*
     * создаёт тестового пользователя
     * @params $role - роль пользователя в системе
     */
    public function init_user(int $role)
    {
        $this->seed(\RolesTableSeeder::class);

        $this->user = new User([
            'role_id'    => $role, //1 - manager, 2 - driver
            'name'       => 'Admin',
            'email'      => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '123145678',
            'remember_token' => Str::random(10),
        ]);

        $this->be($this->user);
    }

    /**
     * Тест доступа водителя к get-routes driver
     *
     * @dataProvider driverGetProvider
     *
     * @return void
     */
    public function testDriverGet($route)
    {
        $this->init_user(2);

        $response = $this->get($route);

        $response->assertStatus(200);
    }

    /**
     * Тест отсутствия доступа менеджера к get-routes driver
     *
     * @dataProvider driverGetProvider
     *
     * @return void
     */
    public function testManagerGetDenied($route) {

        $this->init_user(1);

        $response = $this->get($route);

        $response->assertStatus(403);

    }

    /**
     * Провайдер get-routes driver
     * @return array
     */
    public function driverGetProvider()
    {
        return [
            "show drivers' trucks" => ['/my_trucks'],
            'truck edit page' => ['/truck_edit'],
        ];
    }

    /**
     * Тест доступа водителя к post-route driver
     *
     * @return void
     */
    public function testPostDriver()
    {
        $this->init_user(2);
        $response = $this->post('/truck_update');
        $response->assertStatus(200);
    }

    /**
     * Тест отсутствия доступа менеджера к post-route manager
     *
     * @return void
     */
    public function testManagerPostDenied() {
        $this->init_user(1);
        $response = $this->post('/truck_update');
        $response->assertStatus(403);
    }
}
