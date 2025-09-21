<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketResource\Pages;
use App\Models\Paket;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Paket';
    protected static ?string $navigationGroup = 'Umrah Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama Paket'),
                Forms\Components\Select::make('jenis')
                    ->options([
                        'Haji' => 'Haji',
                        'Umroh' => 'Umroh',
                    ])
                    ->required()
                    ->label('Jenis Paket'),
                Forms\Components\TextInput::make('durasi')
                    ->required()
                    ->label('Durasi (hari)'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Paket'),
                Tables\Columns\TextColumn::make('jenis')->label('Jenis Paket'),
                Tables\Columns\TextColumn::make('durasi')->label('Durasi (hari)'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePakets::route('/'),
        ];
    }
}