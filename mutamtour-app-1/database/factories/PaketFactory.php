<?php

namespace Database\Factories;

use App\Models\Paket;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaketFactory extends Factory
{
    protected $model = Paket::class;

    public function definition()
    {
        return [
            'jenis' => $this->faker->randomElement(['Haji', 'Umroh']),
            'nama' => $this->faker->word,
            'durasi' => $this->faker->numberBetween(1, 30) . ' hari',
        ];
    }
}