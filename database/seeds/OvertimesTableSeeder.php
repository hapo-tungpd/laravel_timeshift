<?php

use Illuminate\Database\Seeder;

class OvertimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Overtime::class, 20)->create();
    }
}
