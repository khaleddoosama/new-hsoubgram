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
        $images=['j7Ll2InODMOhBeN1ZvZnz5HicG0InR.jpeg','OIP (1).jpeg','OIP (2).jpeg','download.jpeg','2.png','5.png'];
        
        return [
           'description'=>fake()->paragraph(),
           'slug' => Str::slug(fake()->sentence(6)),
           'user_id'=>User::factory(),
           'image'=>'posts/'.fake()->randomElement($images),
           'likes'=>fake()->numberBetween(1,10),

        ];
    }
}