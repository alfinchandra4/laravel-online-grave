<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Package;

$factory->define(Package::class, function (Faker $faker) {
    return [
        'package_code' => $faker->currencyCode,
        'name' => $faker->userName,
        'price' => 100000,
        'active' => 1
    ];
});
