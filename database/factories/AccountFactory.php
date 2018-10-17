<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Accounts::class, function (Faker $faker) {

    $userIds = User::all()->pluck('id')->toArray();

    return [
        'connection' => $faker->numberBetween(0,1),
        'name' => $faker->sentence(),
        'type' => $faker->randomElement(array('MT4', 'MT5')),
        'broker' => $faker->sentence(),
        'suffix' => $faker->word(),
        'user_id' => $faker->randomElement($userIds)
    ];
});
