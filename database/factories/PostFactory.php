<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images=['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg'];
        
        return [
           'description'=>fake()->paragraph(),
           'slug' => Str::slug(fake()->sentence(6)),
           'user_id'=>\App\Models\User::inRandomOrder()->first()->id,
           'image'=>'posts/'.fake()->randomElement($images),
           'likes'=>fake()->numberBetween(1,10),

        ];
    }
}