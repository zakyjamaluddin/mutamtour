<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationLabel = 'Group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('paket_id')
                    ->label('Paket')
                    ->relationship('paket', 'nama')
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->label('Keterangan')
                    ->nullable(),
                Forms\Components\TextInput::make('total_seat')
                    ->label('Total Seat')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('vendor')
                    ->label('Vendor')
                    ->nullable(),
                Forms\Components\TextInput::make('tour_leader')
                    ->label('Tour Leader')
                    ->nullable(),
                Forms\Components\TextInput::make('tanggal')
                    ->label('Tanggal')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('bulan')
                    ->label('Bulan')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('tahun')
                    ->label('Tahun')
                    ->numeric()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('paket.nama')->label('Nama')->description(
                    function (Group $record) {
                        $day = $record->tanggal;
                        $month = $record->bulan;
                        $year = $record->tahun;

                        $namaBulan = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];

                        if ($month && $year) {
                            $bulanTeks = $namaBulan[(int) $month] ?? $month;
                            if ($day) {
                                return (int)$day . ' ' . $bulanTeks . ' ' . $year;
                            }
                            return $bulanTeks . ' ' . $year;
                        }

                        return '-';
                    }
                )->searchable(),
                Tables\Columns\TextColumn::make('sisa_seat')
                    ->label('Sisa Seat')
                    ->state(fn (Group $record) => max(0, ($record->total_seat - 1) - $record->jamaahs()->count()))
                    ->description(fn (Group $record): string => 'Total '.$record->total_seat. ' seat')
                    ->suffix(' seat'),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->default('-')->visibleFrom('md'),
                Tables\Columns\TextColumn::make('vendor')->label('Vendor')->visibleFrom('md'),
                Tables\Columns\TextColumn::make('tour_leader')->label('Tour Leader')->visibleFrom('md'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('paket_id')
                    ->label('Paket')
                    ->relationship('paket', 'nama'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->recordUrl(function (Group $record) {
                return route('filament.admin.resources.jamaahs.index', ['tableFilters[group_id][value]' => $record->id]);
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGroups::route('/'),
        ];
    }
}


