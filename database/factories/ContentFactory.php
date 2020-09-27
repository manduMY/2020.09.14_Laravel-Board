<?php

namespace Database\Factories;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContentFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'context' => $this->faker->text,
        ];
    }
}
