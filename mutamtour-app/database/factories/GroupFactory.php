<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'paket_id' => \App\Models\Paket::factory(),
            'tanggal' => $this->faker->dayOfMonth(),
            'bulan' => $this->faker->month(),
            'tahun' => $this->faker->year(),
            'keterangan' => $this->faker->sentence(),
            'total_seat' => $this->faker->numberBetween(10, 50),
            'vendor' => $this->faker->company(),
            'tour_leader' => $this->faker->name(),
        ];
    }
}