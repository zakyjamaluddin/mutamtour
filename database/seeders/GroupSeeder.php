<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Paket;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $paket = Paket::first();
        if (!$paket) {
            return;
        }

        $groups = [
            ['paket_id' => $paket->id, 'keterangan' => 'Batch 1', 'total_seat' => 40, 'bulan' => 10, 'tahun' => 2025],
            ['paket_id' => $paket->id, 'keterangan' => 'Batch 2', 'total_seat' => 45, 'bulan' => 11, 'tahun' => 2025],
        ];

        foreach ($groups as $data) {
            Group::firstOrCreate([
                'paket_id' => $data['paket_id'],
                'keterangan' => $data['keterangan'],
            ], $data);
        }
    }
}





















