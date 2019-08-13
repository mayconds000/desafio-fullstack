<?php

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'cep' => $faker->name,
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'complement' => '',
        'neighborhood' => $faker->streetSuffix,
        'city' => $faker->city,
        'state' => $faker->state,
    ];
});
