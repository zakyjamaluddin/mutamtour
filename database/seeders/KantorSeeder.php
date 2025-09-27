<?php

namespace Database\Seeders;

use App\Models\Kantor;
use Illuminate\Database\Seeder;

class KantorSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Pusat', 'Cabang Bandung', 'Cabang Surabaya'];
        foreach ($names as $name) {
            Kantor::firstOrCreate(['nama' => $name]);
        }
    }
}






















