<?php

namespace App\Console\Commands;

use App\Events\JamaahAdded;
use App\Models\Jamaah;
use App\Models\Group;
use Illuminate\Console\Command;

class TestJamaahNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:jamaah-notification {jamaah_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test jamaah notification event';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jamaahId = $this->argument('jamaah_id');
        
        $jamaah = Jamaah::with('group.paket')->find($jamaahId);
        
        if (!$jamaah) {
            $this->error("Jamaah with ID {$jamaahId} not found");
            return;
        }
        
        if (!$jamaah->group) {
            $this->error("Jamaah {$jamaah->nama} has no group");
            return;
        }
        
        $this->info("Testing notification for jamaah: {$jamaah->nama}");
        $this->info("Group: {$jamaah->group->paket->nama} ({$jamaah->group->bulan}/{$jamaah->group->tahun})");
        
        // Trigger event
        event(new JamaahAdded($jamaah, $jamaah->group));
        
        $this->info("Event triggered successfully!");
        $this->info("Check the logs and notifications table for results.");
    }
}
