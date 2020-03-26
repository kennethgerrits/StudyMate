<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        Tag::create(['tag' => 'Disappointing']);
        Tag::create(['tag' => 'Fun']);
        Tag::create(['tag' => 'Wont take much time']);
        Tag::create(['tag' => 'Time consuming']);
        Tag::create(['tag' => 'difficult']);
        Tag::create(['tag' => 'FML']);
        Tag::create(['tag' => 'I dont get it, its written by Stefan']);
    }
}
