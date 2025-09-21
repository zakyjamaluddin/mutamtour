<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'Pembayaran';
    
    protected static ?string $slug = 'pembayaran';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jamaah_id')
                    ->label('Jamaah')
                    ->relationship('jamaah', 'nama')
                    ->required(),
                Forms\Components\Select::make('jenis')
                    ->label('Jenis Pembayaran')
                    ->options([
                        'DP' => 'DP',
                        'Vaksin Meningitis' => 'Vaksin Meningitis',
                        'Vaksin Polio' => 'Vaksin Polio',
                        'Passport' => 'Passport',
                        'Biaya Umroh' => 'Biaya Umroh',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->label('Keterangan')
                    ->nullable(),
                Forms\Components\Checkbox::make('is_lunas')
                    ->label('Tandai Jamaah Ini Sebagai Lunas')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get) {
                        if ($state) {
                            // Update the status of the related Jamaah to 'lunas'
                            $jamaah = $get('jamaah_id');
                            if ($jamaah) {
                                $jamaahModel = \App\Models\Jamaah::find($jamaah);
                                if ($jamaahModel) {
                                    $jamaahModel->update(['status_pembayaran' => true]);
                                }
                            }
                        }
                    }),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\Text::make('jamaah.nama')->label('Nama Jamaah'),
                Tables\Columns\Text::make('jenis')->label('Jenis Pembayaran'),
                Tables\Columns\Text::make('jumlah')->label('Jumlah'),
                Tables\Columns\Text::make('keterangan')->label('Keterangan'),
                Tables\Columns\Boolean::make('is_lunas')->label('Lunas'),
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}