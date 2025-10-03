<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';
    protected static ?string $navigationGroup = 'Keuangan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jamaah_id')
                    ->relationship('jamaah', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Jamaah'),
                Forms\Components\Select::make('jenis')
                    ->options([
                        'DP' => 'DP',
                        'Vaksin Meningitis' => 'Vaksin Meningitis',
                        'Vaksin Polio' => 'Vaksin Polio',
                        'Passport' => 'Passport',
                        'Biaya Umroh' => 'Biaya Umroh',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Jenis'),
                Forms\Components\TextInput::make('jumlah')->numeric()->required()->prefix('Rp')->label('Jumlah'),
                Forms\Components\TextInput::make('keterangan')->label('Keterangan')->nullable(),
                Forms\Components\Toggle::make('tandai_lunas')
                    ->label('Tandai jamaah ini sebagai lunas')
                    ->helperText('Saat disimpan, status pembayaran pada jamaah akan menjadi Lunas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jamaah.nama')->label('Jamaah')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('jenis')->label('Jenis')->searchable()->visibleFrom('md'),
                Tables\Columns\TextColumn::make('jumlah')->label('Jumlah')->money('IDR'),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan')->toggleable()->visibleFrom('md'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    // Fitur Cetak Invoice
                    Action::make('cetak_invoice')
                        ->label('Cetak Invoice')
                        ->icon('heroicon-o-printer')
                        ->url(fn ($record) => route('invoice.generate', $record))
                        ->openUrlInNewTab(),
                    
                    
                    
                    
                ]),

                
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


