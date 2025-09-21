<?php

namespace App\Filament\Widgets;

use App\Models\Group;
use App\Models\Jamaah;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class JamaahPerBulanChart extends ChartWidget implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    protected int|string|array $columnSpan = 'full';


    protected function getFormStatePath(): string
    {
        return 'data';
    }
    protected static ?string $heading = 'Jamaah per Bulan (berdasarkan bulan keberangkatan)';

    protected function getData(): array
    {
        $state = $this->form->getState() ?? [];
        $center = isset($state['center_month']) ? Carbon::parse($state['center_month'])->startOfMonth() : Carbon::now()->startOfMonth();
        $window = (int) ($state['window'] ?? 3);
        $months = collect(range(-$window, $window))->map(fn ($i) => $center->copy()->addMonths($i));

        $labels = $months->map(fn (Carbon $d) => $d->format('M Y'))->all();

        $counts = $months->map(function (Carbon $d) {
            $year = $d->year;
            $month = $d->month;
            return Jamaah::whereHas('group', function ($q) use ($year, $month) {
                $q->where('tahun', $year)->where('bulan', $month);
            })->count();
        })->all();

        return [
            'datasets' => [
                [
                    'label' => 'Jamaah',
                    'data' => $counts,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('center_month')
                ->label('Pusat Bulan')
                ->displayFormat('m/Y')
                ->native(false)
                ->reactive(),
            Forms\Components\Select::make('window')
                ->label('Rentang (bulan)')
                ->options([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6])
                ->default(3)
                ->reactive(),
        ];
    }
}


