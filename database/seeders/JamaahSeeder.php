<?php

namespace Database\Seeders;

use App\Models\Jamaah;
use App\Models\Kantor;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JamaahSeeder extends Seeder
{
    public function run(): void
    {
        $kantor = Kantor::first();
        $group = Group::first();
        if (!$kantor || !$group) {
            return;
        }

        $jamaahs = [
            [
                'nama' => 'MASHARI SIHNOTO',
                'alamat' => 'KEDUNGADEM',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SULASIH SIDIK MASTUO',
                'alamat' => 'KEDUNGADEM',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'ABD WAHIB MARUF ANWAR',
                'alamat' => 'TUBAN',
                'kantor_id' => 6,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SUDARTATIK PATKUR SARIADI',
                'alamat' => 'TUBAN',
                'kantor_id' => 6,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'KAMBALI KURDI ALI',
                'alamat' => 'RENGEL',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SURATIN SAPUAN',
                'alamat' => 'RENGEL',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'PRAYITNO SLAMET KUSWADI',
                'alamat' => 'BANYUMAS',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SITI NURUL ZUBAIDAH',
                'alamat' => 'BANYUMAS',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'RIDWAN HANAFI ABDUL RACHIM',
                'alamat' => 'KEDUNGADEM',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'ASRIAH SATIMO',
                'alamat' => 'KEDUNGADEM',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SITI INDASAH DAMARI',
                'alamat' => 'MALO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'AGUS HARI PURWANTO',
                'alamat' => 'KEDUNGADEM',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'LIA PEBRIANA PUSPITASARI',
                'alamat' => 'KEDUNGADEM',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'ISMAIL FAHMI MASUD',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'NOFICA ERLIANA',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'MUHAMMAD AUFA ZAVAIR',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'PARNO KASMANI PARIYAH',
                'alamat' => 'DANDER',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SAMIRAH SAPAR',
                'alamat' => 'DANDER',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'WAJIRAN MATRAJI',
                'alamat' => 'PADANGAN',
                'kantor_id' => 5,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SOELEKAH WAKIJAN',
                'alamat' => 'PADANGAN',
                'kantor_id' => 5,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'GALUH SETIAWAN ROSMI',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'PUDJI RAHAYU SOEGENG',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'KAMDANI WIJI YANGSARI',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'TRI WULAN SUTIKNO RASIM',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SRIYANI DAUKI KAMSI',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'LASIMAN SAMIDJAN SIDIK',
                'alamat' => 'SUMBERJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'FIFIT FITRIAH SUPANDI',
                'alamat' => 'SUMBERJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'MUKADIS KASTOLAN',
                'alamat' => 'DANDER',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'DARMINTO KASTOLAN TARMIN',
                'alamat' => 'KASIMAN',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SUMARNI SUWITO',
                'alamat' => 'KASIMAN',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'HARY AGUS SOESANTO',
                'alamat' => 'SIDOARJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'WIDAYANTI RAHAYU',
                'alamat' => 'SIDOARJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'TOWIYAH DJOYO TARUNO',
                'alamat' => 'SIDOARJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'FIRMAN INDRA MUSTIKA',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'YULIDA SUSILOWATI SUTIONO',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'SUHARI SLAMET KASRI',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'YOELI SETYOWATI SARWO',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'ARIEF PRIHANDOKO',
                'alamat' => 'SURABAYA',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'HERMIN ARI SUGIHASTUTI',
                'alamat' => 'SURABAYA',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'GATOT HARI SUBAGIO',
                'alamat' => 'SURABAYA',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'YALES RINO WIDHOWATI',
                'alamat' => 'SURABAYA',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'AGUS AMINANTO TARTIP',
                'alamat' => 'TUBAN',
                'kantor_id' => 7,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'WINAHYA DHATU LARASATI',
                'alamat' => 'TUBAN',
                'kantor_id' => 7,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'MASAMAH MUJIB AHMAD',
                'alamat' => 'BOJONEGORO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'BAYU WIDYA MARTHA',
                'alamat' => 'SIDOARJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'NURINA ARDIYANTI WAHYU LESTARI',
                'alamat' => 'SIDOARJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'MAFAZA HILYA YUNA',
                'alamat' => 'SIDOARJO',
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
            [
                'nama' => 'BONDAN KUSUMANINGSIH (TOUR LEADER)',
                'alamat' => null,
                'kantor_id' => 4,
                'tanggal_lahir' => null,
                'nomor_wa' => null,
                'group_id' => 3,
                'vaksin_meningitis' => true,
                'vaksin_polio' => true,
                'passport' => true,
                'status_pembayaran' => false,
                
            ],
        ];
        

        foreach ($jamaahs as $data) {
            Jamaah::firstOrCreate([
                'nama' => $data['nama'],
                'tanggal_lahir' => $data['tanggal_lahir'],
            ], $data);
        }
    }
}








