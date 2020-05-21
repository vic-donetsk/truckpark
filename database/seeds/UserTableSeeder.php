<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Manager',
            'email' => 'a@a.a',
            'password' => Hash::make('aaaaaaaa'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Driver',
            'email' => 'b@b.b',
            'password' => Hash::make('bbbbbbbb'),
            'role_id' => 2
        ]);
    }
}
