<?php

namespace App\Filament\Actions;

use App\Models\Jamaah;
use App\Models\Kantor;
use App\Models\Group;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportJamaahAction extends Action
{
    public static function getDefaultName(): string
    {
        return 'import';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Import Jamaah')
            ->icon('heroicon-o-arrow-up-tray')
            ->color('success')
            ->form([
                FileUpload::make('file')
                    ->label('File Excel')
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                    ->required()
                    ->helperText('Upload file Excel dengan format yang sesuai. Download template terlebih dahulu jika belum ada.')
            ])
            ->action(function (array $data) {
                $this->handleImport($data['file']);
            })
            ->modalHeading('Import Data Jamaah')
            ->modalDescription('Upload file Excel untuk mengimpor data jamaah secara massal.')
            ->modalSubmitActionLabel('Import Data')
            ->modalWidth('md');
    }

    protected function handleImport(string $filePath): void
    {
        try {
            $file = Storage::disk('public')->path($filePath);
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            // Skip header row
            $dataRows = array_slice($rows, 1);
            
            $importedCount = 0;
            $errors = [];
            
            foreach ($dataRows as $index => $row) {
                try {
                    // Skip empty rows
                    if (empty(array_filter($row))) {
                        continue;
                    }
                    
                    $rowNumber = $index + 2; // +2 because we skipped header and array is 0-indexed
                    
                    // Validate required fields
                    if (empty($row[0]) || empty($row[2])) { // nama and kantor
                        $errors[] = "Baris {$rowNumber}: Nama dan Kantor harus diisi";
                        continue;
                    }
                    
                    // Find kantor by name
                    $kantor = Kantor::where('nama', 'like', '%' . trim($row[2]) . '%')->first();
                    if (!$kantor) {
                        $errors[] = "Baris {$rowNumber}: Kantor '{$row[2]}' tidak ditemukan";
                        continue;
                    }
                    
                    // Find group if provided
                    $group = null;
                    if (!empty($row[6])) { // group column
                        $group = Group::where('keterangan', 'like', '%' . trim($row[6]) . '%')->first();
                    }
                    
                    // Create jamaah
                    Jamaah::create([
                        'nama' => trim($row[0]),
                        'alamat' => trim($row[1] ?? ''),
                        'kantor_id' => $kantor->id,
                        'tanggal_lahir' => !empty($row[3]) ? $this->parseDate($row[3]) : null,
                        'nomor_wa' => trim($row[4] ?? ''),
                        'cs' => trim($row[5] ?? ''),
                        'group_id' => $group?->id,
                        'vaksin_meningitis' => $this->parseBoolean($row[7] ?? ''),
                        'vaksin_polio' => $this->parseBoolean($row[8] ?? ''),
                        'passport' => $this->parseBoolean($row[9] ?? ''),
                        'status_pembayaran' => $this->parseBoolean($row[10] ?? ''),
                    ]);
                    
                    $importedCount++;
                    
                } catch (\Exception $e) {
                    $errors[] = "Baris {$rowNumber}: " . $e->getMessage();
                }
            }
            
            // Clean up uploaded file
            Storage::disk('public')->delete($filePath);
            
            // Show notification
            if ($importedCount > 0) {
                $message = "Berhasil mengimpor {$importedCount} data jamaah.";
                if (!empty($errors)) {
                    $message .= " Terdapat " . count($errors) . " error yang perlu diperbaiki.";
                }
                
                Notification::make()
                    ->title('Import Berhasil')
                    ->body($message)
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Import Gagal')
                    ->body('Tidak ada data yang berhasil diimpor. Periksa format file dan data yang diisi.')
                    ->danger()
                    ->send();
            }
            
            // Log errors for debugging
            if (!empty($errors)) {
                Log::info('Import Jamaah Errors:', $errors);
            }
            
        } catch (\Exception $e) {
            Log::error('Import Jamaah Error: ' . $e->getMessage());
            
            Notification::make()
                ->title('Import Gagal')
                ->body('Terjadi kesalahan saat memproses file. Pastikan file Excel valid dan format sesuai template.')
                ->danger()
                ->send();
        }
    }
    
    private function parseDate($date): ?string
    {
        if (empty($date)) {
            return null;
        }
        
        try {
            if (is_numeric($date)) {
                // Excel date serial number
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
            } else {
                $date = new \DateTime($date);
            }
            
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
    
    private function parseBoolean($value): bool
    {
        if (empty($value)) {
            return false;
        }
        
        $value = strtolower(trim($value));
        return in_array($value, ['1', 'true', 'ya', 'yes', 'v', '✓']);
    }
}