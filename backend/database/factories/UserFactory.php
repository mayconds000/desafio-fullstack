<?php

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->cellphoneNumber,
        'birth_date' => '1990-12-' . rand(1, 31),
        'father_name' => $faker->name('male'),
        'mother_name' => $faker->name('female'),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10)
    ];
});

$factory->afterCreating(User::class, function ($user, $faker) {
    $user->address()->save(factory(Address::class)->make());
});
