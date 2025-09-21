<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JamaahResource\Pages;
use App\Models\Jamaah;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Jamaah';

    protected static ?string $label = 'Jamaah';

    protected static ?string $pluralLabel = 'Jamaah';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama'),
                Forms\Components\TextInput::make('alamat')
                    ->nullable()
                    ->label('Alamat'),
                Forms\Components\Select::make('kantor_id')
                    ->relationship('kantor', 'nama')
                    ->required()
                    ->label('Kantor'),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->nullable()
                    ->label('Tanggal Lahir'),
                Forms\Components\TextInput::make('nomor_wa')
                    ->nullable()
                    ->label('Nomor WA'),
                Forms\Components\Select::make('group_id')
                    ->relationship('group', 'keterangan')
                    ->nullable()
                    ->label('Group'),
                Forms\Components\Toggle::make('vaksin_meningitis')
                    ->default(false)
                    ->label('Vaksin Meningitis'),
                Forms\Components\Toggle::make('vaksin_polio')
                    ->default(false)
                    ->label('Vaksin Polio'),
                Forms\Components\Toggle::make('passport')
                    ->default(false)
                    ->label('Passport'),
                Forms\Components\Toggle::make('status_pembayaran')
                    ->default(false)
                    ->label('Status Pembayaran'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('alamat')->label('Alamat'),
                Tables\Columns\TextColumn::make('kantor.nama')->label('Kantor'),
                Tables\Columns\TextColumn::make('tanggal_lahir')->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('nomor_wa')->label('Nomor WA'),
                Tables\Columns\TextColumn::make('group.keterangan')->label('Group'),
                Tables\Columns\BooleanColumn::make('vaksin_meningitis')->label('Vaksin Meningitis'),
                Tables\Columns\BooleanColumn::make('vaksin_polio')->label('Vaksin Polio'),
                Tables\Columns\BooleanColumn::make('passport')->label('Passport'),
                Tables\Columns\BooleanColumn::make('status_pembayaran')->label('Status Pembayaran'),
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
            'index' => Pages\ManageJamaahs::route('/'),
        ];
    }
}