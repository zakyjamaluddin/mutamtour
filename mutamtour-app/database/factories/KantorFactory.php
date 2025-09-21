<?php

namespace Database\Factories;

use App\Models\Kantor;
use Illuminate\Database\Eloquent\Factories\Factory;

class KantorFactory extends Factory
{
    protected $model = Kantor::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->company,
        ];
    }
}