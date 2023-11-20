<?php

namespace Database\Factories;

use App\Models\Permissions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('2023-10-01', '2023-10-31');
        $updatedAt = null;
        if (fake()->boolean(20)) {
            $updatedAt = fake()->dateTime();
        }

        return [
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
            'user_id' => fake()->numberBetween(1, 300),
        ];

    }
}
