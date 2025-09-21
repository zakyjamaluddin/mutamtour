<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    public function run()
    {
        Paket::create([
            'jenis' => 'Umroh',
            'nama' => 'Paket Umroh Reguler',
            'durasi' => 7,
        ]);

        Paket::create([
            'jenis' => 'Umroh',
            'nama' => 'Paket Umroh Spesial',
            'durasi' => 10,
        ]);

        Paket::create([
            'jenis' => 'Haji',
            'nama' => 'Paket Haji Reguler',
            'durasi' => 30,
        ]);

        Paket::create([
            'jenis' => 'Haji',
            'nama' => 'Paket Haji Khusus',
            'durasi' => 40,
        ]);
    }
}