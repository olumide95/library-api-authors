<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Author::class, function (Faker\Generator $faker) {
    return [
        'uuid' => Str::uuid(),
        'gender' => $gender = $faker->randomElement(['male','female']),
        'name' => $faker->name($gender),
        'country' => $faker->country,
    ];
});
