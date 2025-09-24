<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            ['jenis' => 'Umroh', 'nama' => 'Umroh Reguler', 'durasi' => 9],
            ['jenis' => 'Umroh', 'nama' => 'Umroh Plus Turki', 'durasi' => 12],
            ['jenis' => 'Haji', 'nama' => 'Haji ONH Plus', 'durasi' => 30],
        ];

        foreach ($pakets as $data) {
            Paket::firstOrCreate(['nama' => $data['nama']], $data);
        }
    }
}





















