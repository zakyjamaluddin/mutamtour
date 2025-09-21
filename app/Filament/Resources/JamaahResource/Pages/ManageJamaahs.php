<?php

namespace App\Filament\Resources\JamaahResource\Pages;

use Filament\Actions;
use App\Filament\Resources\JamaahResource;
use App\Models\Jamaah;
use App\Filament\Actions\ImportJamaahAction;
use App\Filament\Actions\DownloadTemplateAction;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ManageJamaahs extends ManageRecords
{
    protected static string $resource = JamaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jamaah')
                ->modalHeading('Tambah Jamaah Baru'),
            
            ImportJamaahAction::make(),
            
            DownloadTemplateAction::make(),
            
            ExportAction::make()
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename('jamaah-export-' . now()->format('Y-m-d-H-i-s'))
                ]),
        ];
    }
}


