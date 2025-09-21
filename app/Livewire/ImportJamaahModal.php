<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Filament\Actions\ImportJamaahAction;
use App\Filament\Actions\DownloadTemplateAction;

class ImportJamaahModal extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $file;

    protected $listeners = ['openImportModal' => 'openModal'];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->file = null;
    }

    public function downloadTemplate()
    {
        return redirect()->route('jamaah.template.download');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240', // 10MB max
        ]);

        try {
            $importAction = new ImportJamaahAction();
            $importAction->handleImport($this->file->store('imports', 'public'));
            
            $this->closeModal();
            $this->dispatch('refreshTable');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat mengimpor file: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.import-jamaah-modal');
    }
}

