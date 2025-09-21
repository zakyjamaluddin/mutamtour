<?php

namespace App\Filament\Resources\PaketResource\Pages;

use App\Filament\Resources\PaketResource;
use Filament\Resources\Pages\ManageRecords;
use Filament\Actions;

class ManagePakets extends ManageRecords
{
    protected static string $resource = PaketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Paket')
                ->modalHeading('Tambah Paket Baru'),
        ];
    }
}


