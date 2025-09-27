<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function afterCreate(): void
    {
        $data = $this->data;
        if (!empty($data['tandai_lunas']) && !empty($data['jamaah_id'])) {
            \App\Models\Jamaah::where('id', $data['jamaah_id'])->update(['status_pembayaran' => true]);
        }
    }
}






















