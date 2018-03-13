<?php

use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(\App\Models\Absence::class, function (Faker $faker) {
    $absenceDate = $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d');
    $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeBetween($absenceDate . ' 8:30:00', $absenceDate . ' 18:00:00')->format('Y-m-d H:i:s'));
    $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $faker->dateTimeBetween($startTime->toDateTimeString(), $absenceDate . ' 18:00:00')->format('Y-m-d H:i:s'));

    return [
        'start_time' => $startTime->toDateTimeString(),
        'end_time' => $endTime->toDateTimeString(),

        'day' => $absenceDate,
        'type' => $faker->randomElement([1, 2, 3]),
        'content' => $faker->text($maxNbChars = 100),
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
    ];
});
