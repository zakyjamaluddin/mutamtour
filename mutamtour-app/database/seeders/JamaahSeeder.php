<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JamaahSeeder extends Seeder
{
    public function run()
    {
        DB::table('jamaah')->insert([
            [
                'nama' => 'Ahmad',
                'alamat' => 'Jl. Merdeka No. 1',
                'kantor_id' => 1,
                'tanggal_lahir' => '1990-01-01',
                'nomor_wa' => '081234567890',
                'group_id' => 1,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => true,
            ],
            [
                'nama' => 'Fatimah',
                'alamat' => 'Jl. Pahlawan No. 2',
                'kantor_id' => 1,
                'tanggal_lahir' => '1995-05-05',
                'nomor_wa' => '081234567891',
                'group_id' => 1,
                'vaksin_meningitis' => true,
                'vaksin_polio' => false,
                'passport' => true,
                'status_pembayaran' => false,
            ],
            [
                'nama' => 'Budi',
                'alamat' => null,
                'kantor_id' => 2,
                'tanggal_lahir' => '1988-08-08',
                'nomor_wa' => '081234567892',
                'group_id' => 2,
                'vaksin_meningitis' => false,
                'vaksin_polio' => true,
                'passport' => false,
                'status_pembayaran' => false,
            ],
            // Add more records as needed
        ]);
    }
}