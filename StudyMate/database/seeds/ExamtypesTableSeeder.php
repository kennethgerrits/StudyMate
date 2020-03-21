<?php

use Illuminate\Database\Seeder;
use App\ExamType;
class ExamtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_types')->delete();

        ExamType::create(['type' => 'exam']);
        ExamType::create(['type' => 'assessment']);
        ExamType::create(['type' => 'assignment']);
    }
}
