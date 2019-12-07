<?php

use Illuminate\Database\Seeder;

class CarsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Car::class,6)->create();

        $tags = factory(App\Tag::class,6)->create();

        App\Car::All()->each(function ($car) use ($tags){
            //$car->tags()->saveMany($tags);
            $car->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
