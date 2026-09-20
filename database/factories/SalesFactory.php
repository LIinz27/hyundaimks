<?php

namespace Database\Factories;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Sales>
 */
class SalesFactory extends Factory
{
    protected $model = Sales::class;

    public function definition(): array
    {
        $name = fake()->name();

        return [
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 99999),
            'name' => $name,
            'title' => fake()->jobTitle(),
            'bio' => fake()->paragraph(),
            'photo_path' => null,
            'whatsapp' => '62'.fake()->numerify('8#########'),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'is_active' => true,
            'sort_order' => 0,
        ];
    }
}
