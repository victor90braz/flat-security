<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Flat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends Factory<Flat>
 */
class FlatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->word,
            'price' => $this->faker->randomNumber(4),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city,
            'category_id' => Category::factory()->create()->id,
        ];
    }
}
