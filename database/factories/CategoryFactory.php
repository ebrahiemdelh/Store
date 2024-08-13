<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model=Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->unique()->words(2,true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description'=>$this->faker->sentence(15),
            'image'=>$this->faker->imageUrl(),
            // 'parent_id' => Category::inRandomOrder()->first()->id,
            'parent_id' => null,
            'status' => $this->faker->randomElement(['active','archived']),
        ];
    }
}