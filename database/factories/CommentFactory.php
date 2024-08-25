<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\data;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
   
    protected $model = data::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'description'=>str()->random(10),
            'created_by_id'=>mt_rand(001, 999),
            'updated_by_id'=>mt_rand(001, 999)
        ];
    }
}
