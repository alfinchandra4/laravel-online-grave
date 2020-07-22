<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\PackageDetail;

$factory->define(PackageDetail::class, function (Faker $faker) {
    return [
        'package_id' => 1,
        'value' => $faker->text($maxNbChars = 30)
    ];
});
