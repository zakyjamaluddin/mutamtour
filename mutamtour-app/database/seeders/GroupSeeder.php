<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    public function run()
    {
        DB::table('groups')->insert([
            [
                'paket_id' => 1,
                'tanggal' => 15,
                'bulan' => 5,
                'tahun' => 2024,
                'keterangan' => 'Group A Umrah',
                'total_seat' => 20,
                'vendor' => 'Vendor A',
                'tour_leader' => 'Tour Leader A',
            ],
            [
                'paket_id' => 2,
                'tanggal' => 20,
                'bulan' => 6,
                'tahun' => 2024,
                'keterangan' => 'Group B Umrah',
                'total_seat' => 25,
                'vendor' => 'Vendor B',
                'tour_leader' => 'Tour Leader B',
            ],
            [
                'paket_id' => 1,
                'tanggal' => 10,
                'bulan' => 7,
                'tahun' => 2024,
                'keterangan' => 'Group C Umrah',
                'total_seat' => 30,
                'vendor' => 'Vendor C',
                'tour_leader' => 'Tour Leader C',
            ],
        ]);
    }
}