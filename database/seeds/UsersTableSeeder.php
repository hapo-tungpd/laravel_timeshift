<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 20)->create();
        \App\Models\User::create([
            "email" => "hapo@haposoft.com",
            "name" => "Haposoft",
            "password" => bcrypt("123456"),
            'remember_token' => str_random(10),
            'phone' => '0912201718',
            'birthday' => '1997-11-03',
            'gender' => 1,
            'address' => 'Hanoi',
            'JLPT' => 'N3'
        ]);
    }
}
