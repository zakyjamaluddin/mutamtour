<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JamaahTemplateExport;

class DownloadTemplateAction extends Action
{
    public static function getDefaultName(): string
    {
        return 'download_template';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Download Template')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('info')
            ->url(fn () => route('jamaah.template.download'))
            ->openUrlInNewTab();
    }
}

