<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Report::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
        'day' => $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d'),
        'today' => $faker->text($maxNbChars = 100),
        'tomorrow' => $faker->text($maxNbChars = 100),
        'problem' => $faker->text($maxNbChars = 100),
    ];
});
