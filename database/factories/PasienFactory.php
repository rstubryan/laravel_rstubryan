<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pasien' => fake()->name(),
            'alamat' => fake()->address(),
            'no_telpon' => fake()->phoneNumber(),
            'rumah_sakit_id' => fake()->numberBetween(1, 10)
        ];
    }
}
