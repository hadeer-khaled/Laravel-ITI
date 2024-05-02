<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes ;

use App\Models\Post;
use App\Models\User;



class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    use SoftDeletes;
    
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence,
            'body' => $this->faker->text(200),
            'posted_by' => $this->faker->numberBetween(1, 10), 
            'image' => 'posts/default.png',
        ];
    }
}
