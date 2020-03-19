<?php

use Illuminate\Database\Seeder;
use App\Module;

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
            'overseer' => 'Bart G',
            'taught_by' => 'Jeroen'
        ]);
        Module::create([
            'name' => 'PROG6',
            'overseer' => 'Stijn S',
            'taught_by' => 'Jasper'
        ]);
        Module::create([
            'name' => 'DPINT',
            'overseer' => 'Martijn S',
            'taught_by' => 'Bob'
        ]);
    }
}
