<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exam;
use Faker\Generator as Faker;

$factory->define(Exam::class, function (Faker $faker) {
    return [
        'description' => $faker->title,
        'deadline_date' => $faker->dateTimeBetween('now', '+1 years'),
        'is_finished' => $faker->boolean,
        'module_id' => $faker->randomElement(\App\Module::all()->pluck('id')->toArray()),
        'examtype_id' => $faker->randomElement(\App\ExamType::all()->pluck('id')->toArray()),
    ];
});
