<?php

namespace Database\Factories;

use App\Models\Jamaah;
use Illuminate\Database\Eloquent\Factories\Factory;

class JamaahFactory extends Factory
{
    protected $model = Jamaah::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'alamat' => $this->faker->address,
            'kantor_id' => \App\Models\Kantor::factory(),
            'tanggal_lahir' => $this->faker->date(),
            'nomor_wa' => $this->faker->phoneNumber,
            'group_id' => \App\Models\Group::factory(),
            'vaksin_meningitis' => $this->faker->boolean,
            'vaksin_polio' => $this->faker->boolean,
            'passport' => $this->faker->boolean,
            'status_pembayaran' => $this->faker->boolean,
        ];
    }
}