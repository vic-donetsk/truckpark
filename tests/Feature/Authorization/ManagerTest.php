<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

use App\User;

/*
 * проверка авторизации доступа ко всем manager-routes проекта
 */
class ManagerTest extends TestCase
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
     * Тест доступа менеджера к get-routes manager
     *
     * @dataProvider managerGetProvider
     *
     * @return void
     */
    public function testManagerGet($route)
    {
        $this->init_user(1);

        $response = $this->get($route);

        $response->assertStatus(200);
    }

    /**
     * Тест отсутствия доступа водителя к get-routes manager
     *
     * @dataProvider managerGetProvider
     *
     * @return void
     */
    public function testDriverGetDenied($route) {

        $this->init_user(2);

        $response = $this->get($route);

        $response->assertStatus(403);

    }

    /**
     * Провайдер get-routes manager
     * @return array
     */
    public function managerGetProvider()
    {
        return [
            'show all parks' => ['/parks'],
            'park edit page' => ['/park_edit'],
            'show all trucks' => ['/all_trucks'],
            'get truck driver by truck name' => ['/truck'],
        ];
    }

    /**
     * Тест доступа менеджера к delete-routes manager
     *
     * @dataProvider managerDeleteProvider
     *
     * @return void
     */
    public function testManagerDelete($route)
    {
        $this->init_user(1);

        $response = $this->delete($route);

        $response->assertStatus(200);
    }

    /**
     * Тест отсутствия доступа водителя к delete-routes manager
     *
     * @dataProvider managerDeleteProvider
     *
     * @return void
     */
    public function testDriverDeleteDenied($route) {

        $this->init_user(2);

        $response = $this->delete($route);

        $response->assertStatus(403);

    }

    /**
     * Провайдер get-routes manager
     * @return array
     */
    public function managerDeleteProvider()
    {
        return [
            'delete park' => ['/park_delete'],
            'delete truck' => ['/truck_delete'],
        ];
    }

    /**
     * Тест доступа менеджера к post-route manager
     *
     * @return void
     */
    public function testPostManager()
    {
        $this->init_user(1);
        $response = $this->post('/park_update');
        $response->assertStatus(200);
    }

    /**
     * Тест отсутствия доступа водителя к post-route manager
     *
     * @return void
     */
    public function testDriverPostDenied() {
        $this->init_user(2);
        $response = $this->post('/park_update');
        $response->assertStatus(403);
    }
}
