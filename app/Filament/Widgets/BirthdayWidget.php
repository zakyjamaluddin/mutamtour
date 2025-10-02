<?php

namespace App\Filament\Widgets;

use App\Models\Jamaah;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BirthdayWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function getTableHeading(): string
    {
        return 'Jamaah yang Berulang Tahun';
    }

    protected function getTableQuery(): Builder
{
    $yesterday = Carbon::yesterday();
    $today = Carbon::today();
    $tomorrow = Carbon::tomorrow();

    $dates = [
        $yesterday,
        $today,
        $tomorrow,
    ];

    $query = Jamaah::query()->whereNotNull('tanggal_lahir');

    $query->where(function (Builder $q) use ($dates) {
        foreach ($dates as $date) {
            $day = sprintf('%02d', $date->day);
            $month = sprintf('%02d', $date->month);
            $q->orWhereRaw("strftime('%d', tanggal_lahir) = ? AND strftime('%m', tanggal_lahir) = ?", [$day, $month]);
        }
    });

    // order by birthday
    $query->orderByRaw("CASE 
        WHEN strftime('%d-%m', tanggal_lahir) = ? THEN 1
        WHEN strftime('%d-%m', tanggal_lahir) = ? THEN 2
        WHEN strftime('%d-%m', tanggal_lahir) = ? THEN 3
        ELSE 4 END", [
            $yesterday->format('d-m'),
            $today->format('d-m'),
            $tomorrow->format('d-m'),
    ]);

    return $query;
}


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->description(fn (Jamaah $record): string => $record->kantor->nama)
                    ->sortable()
                    ->wrap()
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->url(fn (Jamaah $record) => route('filament.admin.resources.jamaahs.view', $record)),
            Tables\Columns\TextColumn::make('tanggal_lahir')->date('d F')->label('Tanggal Lahir'),
            Tables\Columns\TextColumn::make('status_ultah')
                ->label('Status')
                ->badge()
                ->getStateUsing(function ($record) {
                    $tanggal = $record->tanggal_lahir;
                    if (!$tanggal) return '-';
                    $birthDate = Carbon::parse($tanggal);
                    
                    if ($birthDate->isBirthday(Carbon::yesterday())) return 'Kemarin';
                    if ($birthDate->isBirthday(Carbon::today())) return 'Hari Ini';
                    if ($birthDate->isBirthday(Carbon::tomorrow())) return 'Besok';
                    return '-';
                })
                ->color(fn ($state) => match ($state) {
                    'Kemarin' => 'gray',
                    'Hari Ini' => 'success',
                    'Besok' => 'info',
                    default => 'secondary',
                })
                ->default('-'),

        ];
    }
}