<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Truck;
use App\User;
use Faker\Generator as Faker;

$factory->define(Truck::class, function (Faker $faker) {

    $user = User::first();

    return [
        'name' => $faker->name,
        'driver' => $faker->name,
        'user_id' => $user->id
    ];
});
