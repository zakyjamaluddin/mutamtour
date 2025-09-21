<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Models\Group;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'Groups';
    
    protected static ?string $pluralModelLabel = 'Groups';
    
    protected static ?string $modelLabel = 'Group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('paket_id')
                    ->label('Package')
                    ->relationship('paket', 'nama')
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->label('Description')
                    ->nullable(),
                Forms\Components\TextInput::make('total_seat')
                    ->label('Total Seats')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('vendor')
                    ->label('Vendor')
                    ->nullable(),
                Forms\Components\TextInput::make('tour_leader')
                    ->label('Tour Leader')
                    ->nullable(),
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Date')
                    ->nullable(),
                Forms\Components\TextInput::make('bulan')
                    ->label('Month')
                    ->nullable()
                    ->numeric(),
                Forms\Components\TextInput::make('tahun')
                    ->label('Year')
                    ->nullable()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Text::make('paket.nama')->label('Package'),
                Tables\Columns\Text::make('keterangan')->label('Description'),
                Tables\Columns\Text::make('total_seat')->label('Total Seats'),
                Tables\Columns\Text::make('vendor')->label('Vendor'),
                Tables\Columns\Text::make('tour_leader')->label('Tour Leader'),
                Tables\Columns\Text::make('tanggal')->label('Date'),
                Tables\Columns\Text::make('bulan')->label('Month'),
                Tables\Columns\Text::make('tahun')->label('Year'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGroups::route('/'),
        ];
    }
}