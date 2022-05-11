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
            'name' => $this->faker->text,
            'address' => $this->faker->address,
            'propertyType' => $this->faker->uuid,
            // 'fields' => array()
        ];
    }
}
