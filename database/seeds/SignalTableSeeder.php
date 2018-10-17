<?php

use Illuminate\Database\Seeder;

class SignalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Signal', 10)->create();
    }
}
