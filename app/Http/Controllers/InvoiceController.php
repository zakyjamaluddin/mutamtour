<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Facades\File;

class InvoiceController extends Controller
{
    public function generate(Pembayaran $pembayaran)
    {
        $pembayaran->load(['jamaah', 'jamaah.group', 'jamaah.group.paket']);
        
        $pdf = Pdf::loadView('invoice', [
            'pembayaran' => $pembayaran,
            'jamaah' => $pembayaran->jamaah,
            'group' => $pembayaran->jamaah->group,
            'paket' => $pembayaran->jamaah->group->paket ?? null,
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('invoice-' . $pembayaran->id . '.pdf');
    }
    
    public function view(Pembayaran $pembayaran)
    {
        $pembayaran->load(['jamaah', 'jamaah.group', 'jamaah.group.paket']);
        
        return view('invoice', [
            'pembayaran' => $pembayaran,
            'jamaah' => $pembayaran->jamaah,
            'group' => $pembayaran->jamaah->group,
            'paket' => $pembayaran->jamaah->group->paket ?? null,
        ]);
    }

    public function generateInvoice($pembayaranId)
    {
        // 1. Ambil Data (Asumsi data sudah Anda ambil dari database)
        $pembayaran = \App\Models\Pembayaran::findOrFail($pembayaranId);
        $jamaah = $pembayaran->jamaah;
        $group = $pembayaran->group;

        // 2. Set Konfigurasi PDF
        // Atur DomPDF sebagai renderer PDF
        Settings::setPdfRenderer(
            Settings::PDF_RENDERER_DOMPDF,
            base_path('vendor/dompdf/dompdf') // Path ke folder DomPDF
        );
        
        // 3. Muat Template Word
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(
            storage_path('app/templates/invoice.docx')
        );

        // 4. Ganti Placeholder dengan Data (Contoh)
        $tanggal_keberangkatan = 'Belum ditentukan';
        if ($group) {
            $bulanMap = [
                1 => 'Januari', 
                2 => 'Februari', 
                3 => 'Maret', 
                4 => 'April', 
                5 => 'Mei', 
                6 => 'Juni', 
                7 => 'Juli', 
                8 => 'Agustus', 
                9 => 'September', 
                10 => 'Oktober', 
                11 => 'November', 
                12 => 'Desember'
            ];
            $bulan = $bulanMap[(int) $group->bulan] ?? $group->bulan;
            $tanggal_keberangkatan = "{$group->tanggal} {$bulan} {$group->tahun}";
        }
        
        $templateProcessor->setValue('nomor_invoice', $pembayaran->id);
        
        // Data Jamaah
        $templateProcessor->setValue('nama', strtoupper($jamaah->nama));
        $templateProcessor->setValue('alamat', $jamaah->alamat ?? '-');
        $templateProcessor->setValue('nomor_Wa', $jamaah->nomor_wa ?? '-');
        
        // Data Group
        $templateProcessor->setValue('nama_paket', $group->paket->nama ?? 'Belum terdaftar');
        $templateProcessor->setValue('tanggal_keberangkatan', $tanggal_keberangkatan);
        
        // Data Pembayaran
        $templateProcessor->setValue('JENIS_PEMBAYARAN', $pembayaran->jenis);
        $templateProcessor->setValue('JUMLAH', number_format($pembayaran->jumlah, 0, ',', '.'));
        $templateProcessor->setValue('KETERANGAN', $pembayaran->keterangan ?? '-');
        $templateProcessor->setValue('TGL', $pembayaran->created_at->format('d/m/Y H:i'));
        $templateProcessor->setValue('TOTAL', number_format($pembayaran->jumlah, 0, ',', '.'));

        // --- MANAJEMEN DIREKTORI DAN PATH ---

        // A. Persiapan Path DOCX Sementara (storage/app/temp)
        $temp_dir = storage_path('app/temp');
        if (!File::isDirectory($temp_dir)) {
            File::makeDirectory($temp_dir, 0777, true, true);
        }
        $filename_docx = 'Invoice-' . $pembayaran->id . '.docx';
        $temp_path = $temp_dir . '/' . $filename_docx;
        
        // B. Persiapan Path PDF Hasil (storage/app/public/invoices)
        $pdf_output_dir = storage_path('app/public/invoices');
        if (!File::isDirectory($pdf_output_dir)) {
            File::makeDirectory($pdf_output_dir, 0777, true, true); // Pastikan folder 'invoices' dibuat
        }
        $filename_pdf = 'Invoice-' . $pembayaran->id . '.pdf';
        $pdf_path = $pdf_output_dir . '/' . $filename_pdf;

        // 4. Simpan File Word Sementara
        $templateProcessor->saveAs($temp_path);

        // 5. Konversi ke PDF
        $phpWord = IOFactory::load($temp_path);
        $phpWord->save($pdf_path, 'PDF'); // Ini yang memicu error jika folder 'invoices' belum ada

        // 6. Bersihkan dan Download
        unlink($temp_path); 
        
        return response()->download($pdf_path)->deleteFileAfterSend(true);
    }
}