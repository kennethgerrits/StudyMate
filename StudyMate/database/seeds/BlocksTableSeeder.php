<?php

use App\Block;
use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blocks')->delete();

        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }

    }
}
