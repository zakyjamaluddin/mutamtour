<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
}