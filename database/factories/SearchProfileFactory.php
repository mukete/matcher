<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SearchProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $faker->text,
            'propertyType' => $faker->uuid,
            // 'fields' => array()
        ];
    }
}
