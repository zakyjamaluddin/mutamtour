<?php

namespace Database\Seeders;

use App\Models\Jamaah;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $jamaah = Jamaah::first();
        if (!$jamaah) {
            return;
        }

        $payments = [
            ['jamaah_id' => $jamaah->id, 'jenis' => 'DP', 'jumlah' => 5000000, 'keterangan' => 'Pembayaran DP awal'],
            ['jamaah_id' => $jamaah->id, 'jenis' => 'Biaya Umroh', 'jumlah' => 20000000, 'keterangan' => 'Pelunasan sebagian'],
        ];

        foreach ($payments as $data) {
            Pembayaran::create($data);
        }
    }
}






















