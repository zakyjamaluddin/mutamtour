<?php

namespace App\Filament\Resources\JamaahResource\Widgets;

use App\Models\Pembayaran;
use App\Models\Jamaah;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class PembayaranTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Riwayat Pembayaran';

    public ?Jamaah $jamaah = null;

    protected function getTableQuery(): Builder
    {
        if (!$this->jamaah) {
            return Pembayaran::query()->where('id', 0);
        }
        
        return Pembayaran::query()->where('jamaah_id', $this->jamaah->id);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Pembayaran Baru')
                    ->icon('heroicon-o-plus')
                    ->form([
                        Forms\Components\Select::make('jenis')
                            ->label('Jenis Pembayaran')
                            ->options([
                                'DP' => 'DP (Down Payment)',
                                'Vaksin Meningitis' => 'Vaksin Meningitis',
                                'Vaksin Polio' => 'Vaksin Polio',
                                'Passport' => 'Passport',
                                'Biaya Umroh' => 'Biaya Umroh',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(1),
                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->placeholder('Masukkan keterangan pembayaran (opsional)')
                            ->rows(3),
                        Forms\Components\Toggle::make('tandai_lunas')
                            ->label('Tandai sebagai Lunas')
                            ->helperText('Centang jika pembayaran ini membuat status jamaah menjadi lunas')
                            ->default(false),
                    ])
                    ->using(function (array $data) {
                        $data['jamaah_id'] = $this->jamaah->id;
                        $tandaiLunas = $data['tandai_lunas'] ?? false;
                        unset($data['tandai_lunas']);

                        $pembayaran = Pembayaran::create($data);

                        // Jika checkbox "tandai sebagai lunas" dicentang, update status_pembayaran jamaah
                        if ($tandaiLunas && $this->jamaah) {
                            $this->jamaah->status_pembayaran = true;
                            $this->jamaah->save();
                        }

                        return $pembayaran;
                    })
                    ->successNotificationTitle('Pembayaran berhasil ditambahkan')
                    ->visible(fn (): bool => $this->jamaah !== null),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'DP' => 'primary',
                        'Vaksin Meningitis' => 'info',
                        'Vaksin Polio' => 'info',
                        'Passport' => 'warning',
                        'Biaya Umroh' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->placeholder('Tidak ada keterangan')
                    ->toggleable()
                    ->visibleFrom('md'),
                
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum Ada Pembayaran')
            ->emptyStateDescription('Jamaah ini belum memiliki riwayat pembayaran.')
            ->emptyStateIcon('heroicon-o-credit-card');
    }
}
