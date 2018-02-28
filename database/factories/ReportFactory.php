<?php

use Faker\Generator as Faker;

$factory->define(\App\Report::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'report_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d'),
        'today' => $faker->text($maxNbChars = 100),
        'tomorrow' => $faker->text($maxNbChars = 100),
        'problem' => $faker->text($maxNbChars = 100),
    ];
});
