<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->text(8),
            'content' => $this->faker->text(100),
            'created_by' =>  User::all()->random()->id
        ];
    }
}