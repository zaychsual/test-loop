<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => Post::all()->random()->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'comment' => $this->faker->text(),
            'website' => $this->faker->domainName(),
            'created_at' => Carbon::now(),
        ];
    }
}
