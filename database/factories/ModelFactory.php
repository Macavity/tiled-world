<?php

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

/**
 * @var \Illuminate\Database\Eloquent\Factory
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Modules\Character\Entities\Character::class, function(Faker\Generator $generator){
    return [
        'name' => $generator->name,
        'gender' => $generator->numberBetween(0,1),
        'job' => $generator->numberBetween(1,6),
        'base_level' => $generator->numberBetween(1,40),
        'job_level' => $generator->numberBetween(1,49),
        'hair_color' => $generator->hexColor,
        'hair_style' => $generator->numberBetween(1,20),
    ];
});