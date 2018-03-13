<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(RollCallsTableSeeder::class);
         $this->call(AbsencesTableSeeder::class);
         $this->call(OvertimesTableSeeder::class);
         $this->call(ReportsTableSeeder::class);
         $this->call(SalariesTableSeeder::class);
    }
}
