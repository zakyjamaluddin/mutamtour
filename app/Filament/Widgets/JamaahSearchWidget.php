<?php

namespace App\Filament\Widgets;

use App\Models\Jamaah;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class JamaahSearchWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function getTableHeading(): string
    {
        return 'Pencarian Jamaah';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Jamaah::query())
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->description(fn (Jamaah $record): string => $record->kantor->nama)
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->wrap()
                    ->formatStateUsing(fn ($state) => strtoupper($state)),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
               
            ])
            ->bulkActions([
                //
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.jamaahs.view', $record));
    }
}