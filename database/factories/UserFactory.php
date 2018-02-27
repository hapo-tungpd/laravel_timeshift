<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'phone' => $faker->tollFreePhoneNumber(),
        'birthday' => $faker->dateTime($max = '1998-1-1', $timezone = null),
        'gender' => $faker->randomElement([0, 1]),
        'address' => $faker->city,
        'JLPT' => $faker->randomElement(['None', 'N1', 'N2', 'N3', 'N4', 'N5']),
        'image' => str_random(20),
    ];
});
