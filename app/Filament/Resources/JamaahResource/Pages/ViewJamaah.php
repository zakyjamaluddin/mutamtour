<?php

namespace App\Filament\Resources\JamaahResource\Pages;

use App\Filament\Resources\JamaahResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ViewJamaah extends ViewRecord
{
    protected static string $resource = JamaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Jamaah')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama')
                            ->label('Nama Lengkap'),
                        Infolists\Components\TextEntry::make('alamat')
                            ->label('Alamat')
                            ->placeholder('Tidak ada alamat'),
                        Infolists\Components\TextEntry::make('kantor.nama')
                            ->label('Kantor'),
                        Infolists\Components\TextEntry::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->date('d F Y')
                            ->placeholder('Tidak ada tanggal lahir'),
                        Infolists\Components\TextEntry::make('nomor_wa')
                            ->label('Nomor WhatsApp')
                            ->placeholder('Tidak ada nomor WA'),
                        Infolists\Components\TextEntry::make('group')
                            ->label('Group')
                            ->formatStateUsing(function ($state, $record) {
                                if (!$record->group) {
                                    return 'Belum ada group';
                                }
                                $group = $record->group;
                                $paketNama = $group->paket->nama ?? '-';
                                $tanggal = $group->tanggal;
                                $bulan = $group->bulan;
                                $tahun = $group->tahun;
                                $keterangan = $group->keterangan ?? '';
                                $bulanMap = [
                                    1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                                    7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                ];
                                $bulanTeks = $bulanMap[(int) $bulan] ?? $bulan;
                                $tanggalStr = ($bulan && $tahun) ? "{$tanggal} {$bulanTeks} {$tahun}" : '-';
                                return "{$paketNama} {$tanggalStr} {$keterangan}";
                            })
                            ->placeholder('Belum ada group'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Status Dokumen & Kesehatan')
                    ->schema([
                        Infolists\Components\TextEntry::make('vaksin_meningitis')
                            ->label('Vaksin Meningitis')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sudah' : 'Belum')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('vaksin_polio')
                            ->label('Vaksin Polio')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sudah' : 'Belum')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('passport')
                            ->label('Passport')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sudah' : 'Belum')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger'),
                        Infolists\Components\TextEntry::make('status_pembayaran')
                            ->label('Status Pembayaran')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Sudah Lunas' : 'Belum Lunas')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'warning'),
                        

                        Infolists\Components\TextEntry::make('pembayaran')
                            ->label('Total Pembayaran')
                            ->formatStateUsing(function ($state, $record) {
                                if (!$record->pembayaran) {
                                    return 'Belum ada Pembayaran';
                                }
                                $total = $record->pembayaran()->sum('jumlah');
                                return 'Rp ' . number_format($total, 0, ',', '.');
                            })
                            ->placeholder('Belum ada Pembayaran'),
                    ])
                    ->columns(2),
            ]);
    }

    protected function getFooterWidgets(): array
    {
        return [
            JamaahResource\Widgets\PembayaranTableWidget::make([
                'jamaah' => $this->record, // <-- Kunci perbaikan di sini
            ]),
        ];
    }
}

