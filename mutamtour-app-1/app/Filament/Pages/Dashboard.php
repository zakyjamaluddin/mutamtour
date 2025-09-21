<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $resource = 'App\Filament\Resources\JamaahResource';

    protected function getTitle(): string
    {
        return 'Dashboard';
    }

    protected function getWidgets(): array
    {
        return [
            // Add your widgets here
        ];
    }
}