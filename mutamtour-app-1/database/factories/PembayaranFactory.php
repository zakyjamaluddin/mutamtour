<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Jamaah;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    public function definition()
    {
        return [
            'jamaah_id' => Jamaah::factory(),
            'jenis' => $this->faker->randomElement(['DP', 'Vaksin Meningitis', 'Vaksin Polio', 'Passport', 'Biaya Umroh', 'Lainnya']),
            'jumlah' => $this->faker->numberBetween(100000, 10000000),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}