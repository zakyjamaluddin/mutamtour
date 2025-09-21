<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JamaahTemplateExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        // Return sample data for template
        return [
            [
                'Ahmad Rizki', // nama
                'Jl. Merdeka No. 123, Jakarta', // alamat
                'Kantor Pusat', // kantor
                '1990-05-15', // tanggal_lahir
                '081234567890', // nomor_wa
                'Budi Santoso', // cs
                'Group A - Januari 2024', // group
                'Ya', // vaksin_meningitis
                'Ya', // vaksin_polio
                'Ya', // passport
                'Ya', // status_pembayaran
            ],
            [
                'Siti Nurhaliza', // nama
                'Jl. Sudirman No. 456, Bandung', // alamat
                'Kantor Cabang Bandung', // kantor
                '1985-12-20', // tanggal_lahir
                '081234567891', // nomor_wa
                'Ani Wijaya', // cs
                'Group B - Februari 2024', // group
                'Tidak', // vaksin_meningitis
                'Tidak', // vaksin_polio
                'Tidak', // passport
                'Tidak', // status_pembayaran
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Nama*',
            'Alamat',
            'Kantor*',
            'Tanggal Lahir (YYYY-MM-DD)',
            'Nomor WA',
            'Customer Service',
            'Group',
            'Vaksin Meningitis (Ya/Tidak)',
            'Vaksin Polio (Ya/Tidak)',
            'Passport (Ya/Tidak)',
            'Status Pembayaran (Ya/Tidak)',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20, // Nama
            'B' => 30, // Alamat
            'C' => 20, // Kantor
            'D' => 15, // Tanggal Lahir
            'E' => 15, // Nomor WA
            'F' => 20, // Customer Service
            'G' => 25, // Group
            'H' => 20, // Vaksin Meningitis
            'I' => 15, // Vaksin Polio
            'J' => 15, // Passport
            'K' => 20, // Status Pembayaran
        ];
    }
}

