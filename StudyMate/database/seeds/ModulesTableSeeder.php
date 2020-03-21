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
            'overseer' =>2,
            'taught_by' => 3,
            'followed_by' => 4,
            'block_id' => 2,
            'period_id' => 2,
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
            'study_points' => 4,
            'is_finished' => true
        ]);
        Module::create([
            'name' => 'DPINT',
            'overseer' => 2,
            'taught_by' => 3,
            'followed_by' => 4,
            'block_id' => 3,
            'period_id' => 2,
            'study_points' => 2,
            'is_finished' => false
        ]);
        Module::create([
            'name' => 'PROJ5',
            'overseer' => 5,
            'taught_by' => 5,
            'followed_by' => 4,
            'block_id' => 5,
            'period_id' => 1,
            'study_points' => 4,
            'is_finished' => false
        ]);
        Module::create([
            'name' => 'ECOME',
            'overseer' => 3,
            'taught_by' => 6,
            'followed_by' => 4,
            'block_id' => 5,
            'period_id' => 1,
            'study_points' => 1,
            'is_finished' => true
        ]);
        Module::create([
            'name' => 'PROG5',
            'overseer' => 5,
            'taught_by' => 2,
            'followed_by' => 4,
            'block_id' => 5,
            'period_id' => 1,
            'study_points' => 3,
            'is_finished' => true
        ]);
        Module::create([
            'name' => 'Unity',
            'overseer' => 6,
            'taught_by' => 3,
            'block_id' => 8,
            'period_id' => 4,
            'study_points' => 2,
            'is_finished' => false
        ]);
        Module::create([
            'name' => 'SWEN5',
            'overseer' => 6,
            'taught_by' => 3,
            'block_id' => 9,
            'period_id' => 1,
            'study_points' => 3,
            'is_finished' => false
        ]);
    }
}
