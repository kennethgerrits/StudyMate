<?php

use Illuminate\Database\Seeder;
use App\Block;
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

        for($i = 0; $i<4; $i++){
        Block::create();
    }

    }
}
