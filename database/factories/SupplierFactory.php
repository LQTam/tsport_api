<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Supplier::class, function (Faker $faker) {
    $users = collect(\App\Models\User::all()->modelKeys());

    return [
        'company_name' => $faker->company,
        'contact_fname' => $faker->firstName,
        'contact_lname' =>$faker->lastName,
        'address' => $faker->address,
        'address2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'user_id' => $users->random(),
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'fax' => $faker->text(25),
        'email' => $faker->email,
        'website' => $faker->url,
        'logo' => $faker->imageUrl(50,50,null,false)
    ];
});
