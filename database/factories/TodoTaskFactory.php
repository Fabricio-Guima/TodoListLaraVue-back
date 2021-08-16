<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TodoTask;
use Faker\Generator as Faker;

$factory->define(TodoTask::class, function (Faker $faker) {
    return [
        
        'label' => $faker->sentence(),
        'is_complete' =>$faker->boolean()
    
    ];
});
