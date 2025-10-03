<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketResource\Pages;
use App\Models\Paket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Paket';
    protected static ?string $navigationGroup = 'Administrator';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jenis')
                    ->options([
                        'Haji' => 'Haji',
                        'Umroh' => 'Umroh',
                    ])
                    ->required()
                    ->label('Jenis'),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama'),
                Forms\Components\TextInput::make('durasi')
                    ->numeric()
                    ->required()
                    ->suffix('hari')
                    ->label('Durasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->description(fn (Paket $record): string => $record->jenis)->searchable(),
                Tables\Columns\TextColumn::make('durasi')->label('Durasi')->suffix(' hari'),
                Tables\Columns\TextColumn::make('groups_count')
                    ->counts('groups')
                    ->label('Jumlah Group')->visibleFrom('md'),
                Tables\Columns\TextColumn::make('jamaah_via_groups')
                    ->label('Total')
                    ->state(function (Paket $record) {
                        return $record->groups()->withCount('jamaahs')->get()->sum('jamaahs_count');
                    })->suffix(' jamaah'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->recordUrl(fn (Paket $record) => route('filament.admin.resources.groups.index', ['tableFilters[paket_id][value]' => $record->id]));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePakets::route('/'),
        ];
    }
}


