<?php

use Illuminate\Database\Seeder;
use App\Admin;
//use  App\Models\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'admin@gmail.com',
        ]);

    }
}
