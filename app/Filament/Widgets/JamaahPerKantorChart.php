<?php

namespace App\Filament\Widgets;

use App\Models\Kantor;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class JamaahPerKantorChart extends ChartWidget
{
    protected static ?string $heading = 'Jamaah per Kantor';
    protected static ?string $maxHeight = '150px';


    protected function getData(): array
    {
        $data = Kantor::withCount('jamaah')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jamaah',
                    'data' => $data->pluck('jamaah_count')->all(),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#C9CBCF',
                        '#7A6F6F',
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $data->pluck('nama')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
        {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'right',
                },
            },
            scales: {
                x: { display: false },
                y: { display: false },
            }
        }
    JS);
    }
}