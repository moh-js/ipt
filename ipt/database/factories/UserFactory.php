<?php

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

$factory->define(App\User::class, function (Faker $faker) {
$rand = ['archtecture', 'computer', 'civil', 'mechanical', 'electrical', 'lab'];
    return [
        'name' => $faker->name,
        'userId' => str_random(6),
        'img' => 'user.png',
        'department' => $rand[array_rand($rand)],
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    ];
});

$factory->afterCreating(App\User::class, function ($user, $faker) {
       
       $user->assignRole('student');
    
});
