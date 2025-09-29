<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Torgodly\Html2Media\Tables\Actions\Html2MediaAction;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';

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
                    // Penggunaan Html2MediaAction seperti ini secara sintaksis sudah benar jika:
                    // 1. Anda sudah mengimpor/menambahkan use Html2MediaAction pada bagian atas file.
                    // 2. Package/plugin Html2MediaAction sudah terinstal dan kompatibel dengan Filament versi Anda.
                    // 3. View 'filament.components.invoice' memang ada dan tidak error.

                    // Namun, jika setelah menambahkan kode ini tampilan Filament Anda menjadi berantakan,
                    // kemungkinan besar ada masalah pada salah satu hal berikut:
                    // - Ada konflik CSS/JS yang di-inject oleh plugin ini.
                    // - View 'filament.components.invoice' mengandung HTML/CSS yang mengganggu layout Filament.
                    // - Ada error JavaScript di browser console akibat plugin atau view tersebut.
                    // - Versi plugin tidak cocok dengan Filament versi Anda.

                    // Saran:
                    // 1. Coba hapus sementara baris ini, lalu cek apakah tampilan kembali normal.
                    // 2. Jika ya, tambahkan kembali satu per satu opsi pada Html2MediaAction untuk mencari penyebabnya.
                    // 3. Pastikan view 'filament.components.invoice' hanya berisi HTML sederhana tanpa CSS global yang bisa mengganggu layout admin.
                    // 4. Cek console browser untuk error JS.
                    // 5. Pastikan package Html2MediaAction sudah update dan kompatibel.

                    // Contoh minimal penggunaan (untuk uji coba):
                    // Html2MediaAction::make('print')
                    //     ->content(fn($record) => view('filament.components.invoice', ['record' => $record])),

                    // Html2MediaAction::make('print')
                    //     ->savePdf()
                    //     ->requiresConfirmation()
                    //     
                    
                    // Ternyata setelah menambahkan ->content, tampilan jadi berantakan.
                    // Solusi sementara: hilangkan ->content agar tidak mengganggu layout.
                    Html2MediaAction::make('prints')
                    ->savePdf()
                    ->content(fn($record) => view('invoice', ['record' => $record])),
                    
                    
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


