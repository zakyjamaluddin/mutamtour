<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kantor;

class KantorSeeder extends Seeder
{
    public function run()
    {
        Kantor::create([
            'nama' => 'Kantor Pusat',
        ]);

        Kantor::create([
            'nama' => 'Kantor Cabang Jakarta',
        ]);

        Kantor::create([
            'nama' => 'Kantor Cabang Surabaya',
        ]);

        Kantor::create([
            'nama' => 'Kantor Cabang Bandung',
        ]);

        Kantor::create([
            'nama' => 'Kantor Cabang Medan',
        ]);
    }
}