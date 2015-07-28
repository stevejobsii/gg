<?php


$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function ($faker) {
    return [
        'user_id' => 1,
        'title' => $faker->text,
        'body' => $faker->text,
        'published_at' => Carbon\Carbon::now(),
        'photo' => $faker->name,
    ];
});

