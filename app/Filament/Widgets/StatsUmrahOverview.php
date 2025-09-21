<?php

namespace App\Filament\Widgets;

use App\Models\Group;
use App\Models\Jamaah;
use App\Models\Paket;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsUmrahOverview extends BaseWidget implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected function getFormStatePath(): string
    {
        return 'data';
    }
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('preset')
                ->options([
                    'this_year' => 'Tahun ini',
                    'last_month' => 'Bulan Lalu',
                    'this_month' => 'Bulan Ini',
                    'next_month' => 'Bulan Depan',
                    'next_year' => 'Tahun Depan',
                ])
                ->label('Preset Waktu')
                ->native(false)
                ->default('this_month')
                ->reactive(),
            Forms\Components\DatePicker::make('start_date')->label('Mulai')->native(false)->reactive(),
            Forms\Components\DatePicker::make('end_date')->label('Selesai')->native(false)->reactive(),
        ];
    }

    protected function getCards(): array
    {
        [$start, $end] = $this->resolveRange();

        $totalGroups = Group::query()
            ->when($start, fn ($q) => $q->where(function ($w) use ($start) {
                $w->where('tahun', '>', $start->year)
                  ->orWhere(function ($x) use ($start) {
                      $x->where('tahun', $start->year)->where('bulan', '>=', $start->month);
                  });
            }))
            ->when($end, fn ($q) => $q->where(function ($w) use ($end) {
                $w->where('tahun', '<', $end->year)
                  ->orWhere(function ($x) use ($end) {
                      $x->where('tahun', $end->year)->where('bulan', '<=', $end->month);
                  });
            }))
            ->count();

        $totalJamaah = Jamaah::query()
            ->whereHas('group', function ($q) use ($start, $end) {
                $q->when($start, fn ($qq) => $qq->where(function ($w) use ($start) {
                    $w->where('tahun', '>', $start->year)
                      ->orWhere(function ($x) use ($start) { $x->where('tahun', $start->year)->where('bulan', '>=', $start->month); });
                }))
                ->when($end, fn ($qq) => $qq->where(function ($w) use ($end) {
                    $w->where('tahun', '<', $end->year)
                      ->orWhere(function ($x) use ($end) { $x->where('tahun', $end->year)->where('bulan', '<=', $end->month); });
                }));
            })
            ->count();

        $totalPaket = Paket::count();

        return [
            Card::make('Total Group', number_format($totalGroups)),
            Card::make('Total Jamaah', number_format($totalJamaah)),
            Card::make('Total Paket', number_format($totalPaket)),
        ];
    }

    private function resolveRange(): array
    {
        $state = $this->form->getState() ?? [];
        $preset = $state['preset'] ?? null;
        $start = $state['start_date'] ?? null;
        $end = $state['end_date'] ?? null;

        if ($preset) {
            $now = Carbon::now();
            return match ($preset) {
                'this_year' => [Carbon::create($now->year, 1, 1), Carbon::create($now->year, 12, 31)],
                'last_month' => [$now->copy()->subMonth()->startOfMonth(), $now->copy()->subMonth()->endOfMonth()],
                'this_month' => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
                'next_month' => [$now->copy()->addMonth()->startOfMonth(), $now->copy()->addMonth()->endOfMonth()],
                'next_year' => [Carbon::create($now->year + 1, 1, 1), Carbon::create($now->year + 1, 12, 31)],
                default => [null, null],
            };
        }

        return [$start ? Carbon::parse($start) : null, $end ? Carbon::parse($end) : null];
    }
}


