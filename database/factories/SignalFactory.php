<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Signal::class, function (Faker $faker) {

    $userIds = User::all()->pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'rank' => $faker->unique()->randomNumber(),
        'name' => $faker->sentence(),
        'description' => $faker->paragraph(2),
        'gain' => $faker->randomFloat(),
        'trades' => $faker->randomNumber(),
        'type' => $faker->randomElement(array('Real', 'Demo')),
        'price' => $faker->randomFloat(2, 2),
    ];
});
