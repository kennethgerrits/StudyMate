<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Module;
use App\User;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'overseer' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'taught_by' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'followed_by' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'block_id' => $faker->randomElement(\App\Block::all()->pluck('id')->toArray()),
        'period_id' => $faker->randomElement(\App\Period::all()->pluck('id')->toArray()),
        'study_points' => $faker->numberBetween(1, 4),
        'is_finished' => $faker->boolean
    ];
});
