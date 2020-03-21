<?php

use Illuminate\Database\Seeder;
use App\ExamType;
use App\Exam;
use Carbon\Carbon;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::create([
            'description' => 'PROG6 Assessment',
            'deadline_date' => Carbon::parse('2020-02-01'),
            'is_finished' => true,
            'module_id' => 2,
            'examtype_id' => ExamType::ASSESSMENT
        ]);

        Exam::create([
            'description' => 'SWEN5 Exam, cheat-sheet allowed',
            'deadline_date' => Carbon::parse('2020-02-01'),
            'is_finished' => false,
            'module_id' => 8,
            'examtype_id' => ExamType::EXAM
        ]);

        Exam::create([
            'description' => 'SWEN5 Assignments',
            'deadline_date' => Carbon::parse('2020-01-01'),
            'is_finished' => false,
            'module_id' => 8,
            'examtype_id' => ExamType::ASSIGNMENT
        ]);

        Exam::create([
            'description' => 'DB1 Exam, be prepared',
            'deadline_date' => Carbon::parse('2020-03-01'),
            'is_finished' => true,
            'module_id' => 1,
            'examtype_id' => ExamType::EXAM
        ]);
    }
}
