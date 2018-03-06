<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Linh',
            'email' => 'ltlinh311@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '0912201718',
            'birthday' => '1997-11-03',
            'gender' => 1,
            'address' => 'Hanoi',
            'image' => '',
            'JLPT' => 'N3'
        ]);
    }
}
