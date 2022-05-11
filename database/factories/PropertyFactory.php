<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
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
            'address' => $faker->address,
            'propertyType' => $faker->uuid,
            // 'fields' => array()
        ];
    }
}
