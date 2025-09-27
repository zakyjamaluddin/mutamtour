<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Resources\Pages\EditRecord;

class EditPembayaran extends EditRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function afterSave(): void
    {
        $data = $this->data;
        if (!empty($data['tandai_lunas']) && !empty($data['jamaah_id'])) {
            \App\Models\Jamaah::where('id', $data['jamaah_id'])->update(['status_pembayaran' => true]);
        }
    }
}






















