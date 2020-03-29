<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exam;
use App\Model;
use App\Role;
use Faker\Generator as Faker;

$factory->define(\App\RoleUser::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(Exam::all()->pluck('id')->toArray()),
        'role_id' => $faker->randomElement(Role::all()->pluck('id')->toArray()),
    ];
});
