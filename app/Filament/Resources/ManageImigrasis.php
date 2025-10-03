<?php

namespace App\Filament\Resources\ImigrasiResource\Pages;

use App\Filament\Resources\ImigrasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageImigrasis extends ManageRecords
{
    protected static string $resource = ImigrasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
