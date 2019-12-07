<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use App\Tag;
use Faker\Generator as Faker;

$factory->define(Car::class, function ($faker) {
    return [
        'brand' => $faker->randomElement(['Audi', 'Skoda', 'Volkswagen', 'Seat', 'Mercdes Benz']),
        'model' => $faker->randomElement(['C Class', 'A 6', 'Passat', 'Jeti', 'Leon']),
        'registration' => $faker->randomElement(['2018', '2002', '2003', '2010', '2012']),
        'engine' => $faker->randomElement(['1.2 L', '1.9 L', '2.0 L', '2.5 L', '3.2 L']),
        'price' => $faker->randomElement([2200, 2500, 3000, 3500, 6000]),
    ];
});

$factory->define(Tag::class, function ($faker) {
    return [
        'name' => $faker->randomElement(['Diesel', 'Red', '5 Doors', 'AMG', 'Gasoline']),
    ];
});
