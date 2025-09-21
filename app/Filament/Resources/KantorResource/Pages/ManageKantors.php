<?php

namespace App\Filament\Resources\KantorResource\Pages;

use App\Filament\Resources\KantorResource;
use Filament\Resources\Pages\ManageRecords;
use Filament\Actions;

class ManageKantors extends ManageRecords
{
    protected static string $resource = KantorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kantor')
                ->modalHeading('Tambah Kantor Baru'),
        ];
    }
}


