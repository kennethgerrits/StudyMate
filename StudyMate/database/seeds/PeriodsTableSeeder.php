<?php

use Illuminate\Database\Seeder;
use App\Period;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->delete();

        for($i = 0; $i<12; $i++){
            Period::create();
        }
    }
}
