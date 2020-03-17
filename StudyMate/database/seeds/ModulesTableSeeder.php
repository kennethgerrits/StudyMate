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
       // DB::table('module_users')->delete();

        Module::create([
            'name' => 'DB1',
            'overseer' => 'Bart G'
        ]);
        Module::create([
            'name' => 'PROG6',
            'overseer' => 'Stijn S'
        ]);
        Module::create([
            'name' => 'DPINT',
            'overseer' => 'Martijn S'
        ]);
    }
}
