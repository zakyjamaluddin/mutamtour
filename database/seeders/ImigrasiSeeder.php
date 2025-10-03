<?php

namespace Database\Seeders;

use App\Models\Imigrasi;
use Illuminate\Database\Seeder;

class ImigrasiSeeder extends Seeder
{
    public function run(): void
    {
        
        $imigrasis = [
            ['nama' => 'Kabupaten Bojonegoro', 'alamat' => 'Jl. Pattimura No. 26 Bojonegoro'],
        ];

        foreach ($imigrasis as $data) {  
            Imigrasi::firstOrCreate(['nama' => $data['nama']], $data);
        }
    }
}






















