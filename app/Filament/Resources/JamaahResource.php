<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Jamaah;
use Filament\Forms\Form;
use App\Models\Pembayaran;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\Layout\Split;
use App\Filament\Resources\JamaahResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Jamaah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->label('Nama')->required(),
                Forms\Components\TextInput::make('alamat')->label('Alamat')->nullable(),
                Forms\Components\Select::make('kantor_id')->relationship('kantor', 'nama')->label('Kantor')->required(),
                Forms\Components\DatePicker::make('tanggal_lahir')->label('Tanggal Lahir')->nullable(),
                Forms\Components\TextInput::make('nomor_wa')->label('Nomor WA')->nullable(),
                Forms\Components\TextInput::make('cs')->label('Customer Service')->placeholder('Nama CS yang membantu pendaftaran')->nullable(),
                Forms\Components\Select::make('group_id')
                    ->label('Group')
                    ->nullable()
                    ->options(function () {
                        $bulanMap = [
                            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                        ];
                        return \App\Models\Group::with('paket')->get()->mapWithKeys(function ($group) use ($bulanMap) {
                            $paketNama = $group->paket?->nama ?? '-';
                            $tanggal = $group->tanggal;
                            $bulan = $bulanMap[(int) $group->bulan] ?? $group->bulan;
                            $tahun = $group->tahun;
                            $keterangan = $group->keterangan ?? '';
                            $label = trim("{$paketNama} {$tanggal} {$bulan} {$tahun} {$keterangan}");
                            return [$group->id => $label];
                        })->toArray();
                    }),
                Forms\Components\Toggle::make('vaksin_meningitis')->label('Vaksin Meningitis')->default(false),
                Forms\Components\Toggle::make('vaksin_polio')->label('Vaksin Polio')->default(false),
                Forms\Components\Toggle::make('passport')->label('Passport')->default(false),
                Forms\Components\Toggle::make('status_pembayaran')->label('Status Pembayaran')->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->description(fn (Jamaah $record): string => $record->kantor->nama)
                    ->sortable()
                    ->wrap()
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                ->searchable(),
                Tables\Columns\TextColumn::make('cs')->label('CS')->placeholder('Tidak ada')->searchable()->sortable()->visibleFrom('md'),
                Tables\Columns\TextColumn::make('kantor.nama')->placeholder('Tidak ada')->searchable()->sortable()->hidden(),
                Tables\Columns\TextColumn::make('group.paket.nama')
                    ->label('Group')
                    ->description(function (Jamaah $record): string {
                        $bulanMap = [
                            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                        ];
                        $tanggal = $record->group->tanggal;
                        $bulan = $bulanMap[(int) $record->group->bulan] ?? $record->group->bulan;
                        $tahun = $record->group->tahun;
                        return "{$tanggal} {$bulan} {$tahun}";
                    })->limit(10)
                    ->suffix(fn (Jamaah $record) => ' ' .$record->group?->keterangan)
                    ->sortable(),
                Tables\Columns\IconColumn::make('vaksin_meningitis')->boolean()->label('Meningitis')->visibleFrom('md'),
                Tables\Columns\IconColumn::make('vaksin_polio')->boolean()->label('Polio')->visibleFrom('md'),
                Tables\Columns\IconColumn::make('passport')->boolean()->label('Passport')->visibleFrom('md'),
                Tables\Columns\IconColumn::make('status_pembayaran')->boolean()->label('Lunas'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group_id')
                    ->label('Group')
                    ->options(function () {
                        return \App\Models\Group::with('paket')->get()->mapWithKeys(function ($group) {
                            $bulanMap = [
                                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                                7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                            ];
                            $tanggal = $group->tanggal;
                            $bulan = $bulanMap[(int) $group->bulan] ?? $group->bulan;
                            $tahun = $group->tahun;
                            $paket = $group->paket?->nama ?? '-';
                            $keterangan = $group->keterangan ?? '';
                            return [
                                $group->id => "{$paket} - {$tanggal} {$bulan} {$tahun} {$keterangan}"
                            ];
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('tambah_pembayaran')
                        ->label('Tambah Pembayaran')
                        ->icon('heroicon-o-plus')
                        ->form([
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
                            Forms\Components\TextInput::make('jumlah')->numeric()->required()->label('Jumlah (Rp)'),
                            Forms\Components\TextInput::make('keterangan')->label('Keterangan')->nullable(),
                            Forms\Components\Checkbox::make('tandai_lunas')->label('Tandai jamaah ini sebagai lunas'),
                        ])
                        ->action(function (Jamaah $record, array $data) {
                            Pembayaran::create([
                                'jamaah_id' => $record->id,
                                'jenis' => $data['jenis'],
                                'jumlah' => $data['jumlah'],
                                'keterangan' => $data['keterangan'] ?? null,
                            ]);

                            if (!empty($data['tandai_lunas'])) {
                                $record->update(['status_pembayaran' => true]);
                            }
                        })
                        ->modalHeading('Tambah Pembayaran')
                        ->modalButton('Simpan'),
                    Tables\Actions\Action::make('ubah_group')
                        ->label('Ubah Group')
                        ->icon('heroicon-o-arrow-path')
                        ->form([
                            Forms\Components\Select::make('group_id')
                                ->label('Group Baru')
                                ->relationship('group', 'keterangan')
                                ->searchable()
                                ->preload()
                                ->required(),
                        ])
                        ->action(function (Jamaah $record, array $data) {
                            $record->update([
                                'group_id' => $data['group_id']
                            ]);
                        })
                        ->modalHeading('Ubah Group Jamaah')
                        ->modalButton('Simpan')
                        ->modalWidth('md'),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ExportBulkAction::make()
            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.jamaahs.view', $record));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageJamaahs::route('/'),
            'view' => Pages\ViewJamaah::route('/{record}'),
        ];
    }
}


