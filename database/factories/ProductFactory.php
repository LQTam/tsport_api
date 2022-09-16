<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'masp'=> uniqid(),
        'product_name' => $faker->word,
        'product_price' => $faker->numberBetween(30,50),
        'product_description' => $faker->paragraph,
        'available_size' => $faker->boolean,
        'available_colors' => $faker->boolean,
        'discount' =>  $faker->numberBetween(10,20),
        'product_available' => $faker->boolean,
        'discount_available' => $faker->boolean,
    ];
});
