<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BirthdayWidget;
use App\Filament\Widgets\JamaahSearchWidget;
use Filament\Pages\Page;

class CRM extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static string $view = 'filament.pages.crm';

    protected static ?string $navigationLabel = 'CRM';


    protected static ?int $navigationSort = 2;

    public function getTitle(): string
    {
        return 'CRM';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BirthdayWidget::class,
            JamaahSearchWidget::class,
        ];
    }
}