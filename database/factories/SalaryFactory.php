<?php

use Faker\Generator as Faker;

$factory->define(\App\Salary::class, function (Faker $faker) {
    $salary = $faker->numberBetween($min = 100, $max = 200);
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'pay_per_hour' => $salary,
        'insurance_money' => $salary * 0.1,
        'final_payment' => $salary * 0.9,
    ];
});
