<?php

namespace App\Listeners;

use App\Events\JamaahAdded;
use App\Services\FirebaseService;
use App\Models\Jamaah;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJamaahNotification implements ShouldQueue
{
    use InteractsWithQueue;

    protected $firebaseService;

    /**
     * Create the event listener.
     */
    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Handle the event.
     */
    public function handle(JamaahAdded $event): void
    {
        Log::info('SendJamaahNotification listener triggered', [
            'jamaah_id' => $event->jamaah->id,
            'group_id' => $event->group->id
        ]);

        $jamaah = $event->jamaah;
        $group = $event->group;

        // Hitung sisa seat
        $totalJamaah = Jamaah::where('group_id', $group->id)->count();
        $sisaSeat = $group->total_seat - $totalJamaah - 1; // -1 untuk tour leader

        $title = "Jamaah Baru Ditambahkan";
        $body = "Jamaah {$jamaah->nama} telah ditambahkan ke group {$group->paket->nama} ({$group->bulan}/{$group->tahun}). Sisa seat: {$sisaSeat}";

        $data = [
            'type' => 'jamaah_added',
            'group_id' => $group->id,
            'jamaah_id' => $jamaah->id,
            'sisa_seat' => $sisaSeat,
            'total_jamaah' => $totalJamaah,
        ];

        Log::info('Sending notification', [
            'title' => $title,
            'body' => $body,
            'data' => $data
        ]);

        // Kirim notifikasi ke semua device
        $result = $this->firebaseService->sendToAll($title, $body, $data);
        
        Log::info('Notification sent result', ['result' => $result]);
    }
}
