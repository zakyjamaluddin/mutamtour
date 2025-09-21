<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('pembayaran')->insert([
            [
                'jamaah_id' => 1,
                'jenis' => 'DP',
                'jumlah' => 1000000,
                'keterangan' => 'Pembayaran DP untuk paket Umrah',
            ],
            [
                'jamaah_id' => 2,
                'jenis' => 'Vaksin Meningitis',
                'jumlah' => 500000,
                'keterangan' => 'Pembayaran vaksin meningitis',
            ],
            [
                'jamaah_id' => 3,
                'jenis' => 'Vaksin Polio',
                'jumlah' => 500000,
                'keterangan' => 'Pembayaran vaksin polio',
            ],
            [
                'jamaah_id' => 1,
                'jenis' => 'Biaya Umroh',
                'jumlah' => 20000000,
                'keterangan' => 'Pembayaran biaya umroh',
            ],
            [
                'jamaah_id' => 4,
                'jenis' => 'Lainnya',
                'jumlah' => 300000,
                'keterangan' => 'Pembayaran tambahan',
            ],
        ]);
    }
}