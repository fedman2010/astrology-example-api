<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Astrologer;
use Faker\Generator as Faker;

$factory->define(Astrologer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstNameFemale,
        'last_name' => $faker->firstNameFemale,
        'email' => $faker->email,
        'bio' => $faker->text(),
    ];
});
