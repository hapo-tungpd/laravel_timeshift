<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(\App\Models\Overtime::class, function (Faker $faker) {
    $overtimeDate = $faker->dateTimeThisYear($max = 'now', $timezone = null)->format('Y-m-d');
    $startTime = Carbon::createFromFormat('H:i', $overtimeDate . ' 18:00');
    $endTime = Carbon::createFromFormat('H:i', $faker->dateTimeBetween($startTime->toDateTimeString(), $overtimeDate . ' 22:00')->format('H:i'));
    return [
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->id;
        },
        'start_time' => $startTime->toDateTimeString(),
        'end_time' => $endTime->toDateTimeString(),
        'day' => $overtimeDate,
        'total_time' => $endTime->diffInHours($startTime),
    ];
});
