<?php

use Illuminate\Database\Seeder;
use \App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = Role::create([
            'name' => 'Менеджер',
            'slug' => 'manager',
            'permissions' => [
                'all-parks' => true,
            ]
        ]);
        $driver = Role::create([
            'name' => 'Водитель',
            'slug' => 'driver',
            'permissions' => [
                'only-own-trucks' => true
            ]
        ]);
    }
}
