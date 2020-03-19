<?php

use Illuminate\Database\Seeder;
use App\Module;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->delete();

        Module::create([
            'name' => 'DB1',
            'overseer' => 1,
            'taught_by' => 2,
            'followed_by' => 3,
            'block_id' => 2,
            'period_id' => 2,
            'year' => Carbon::parse('2020'),
            'study_points' => 4,
            'is_finished' => false
        ]);
        Module::create([
            'name' => 'PROG6',
            'overseer' => 2,
            'taught_by' => 3,
            'followed_by' => 4,
            'block_id' => 1,
            'period_id' => 1,
            'year' => Carbon::parse('2020'),
            'study_points' => 4,
            'is_finished' => true
        ]);
        Module::create([
            'name' => 'DPINT',
            'overseer' => 2,
            'taught_by' => 3,
            'followed_by' => 4,
            'block_id' => 6,
            'period_id' => 2,
            'year' => Carbon::parse('2021'),
            'study_points' => 2,
            'is_finished' => false
        ]);
    }
}
