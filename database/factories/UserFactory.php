<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Станислав Здравков',
        'email' => 'slavizdravkov@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$UaK6AKmd0ixYHby3gczO2.SDn2RyH.8fvjOcI20ujhp7UgOb/P1S6', // password 12345678
        'remember_token' => Str::random(10),
        'created_from' => 'Seeding',
    ];
});
