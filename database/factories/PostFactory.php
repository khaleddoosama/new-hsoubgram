<?php

namespace Database\Factories;

use App\Models\User;
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
        $images=['1.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png'];
        
        return [
           'description'=>fake()->paragraph(),
           'slug' => Str::slug(fake()->sentence(6)),
           'user_id'=>User::factory(),
           'image'=>'posts/'.fake()->randomElement($images),
           'likes'=>fake()->numberBetween(1,10),

        ];
    }
}