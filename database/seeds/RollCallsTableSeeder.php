<?php

use Illuminate\Database\Seeder;

class RollCallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\RollCall::class, 20)->create();
    }
}
