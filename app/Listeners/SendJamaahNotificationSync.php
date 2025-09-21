<?php

namespace App\Listeners;

use App\Events\JamaahAdded;
use App\Services\FirebaseService;
use App\Models\Jamaah;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class SendJamaahNotificationSync
{
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
        Log::info('SendJamaahNotificationSync listener triggered', [
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

        Log::info('Sending notification (sync)', [
            'title' => $title,
            'body' => $body,
            'data' => $data
        ]);

        // Simpan notifikasi ke database dulu
        $notification = Notification::create([
            'title' => $title,
            'body' => $body,
            'type' => 'info',
            'data' => $data,
        ]);

        Log::info('Notification saved to database', ['notification_id' => $notification->id]);

        // Kirim notifikasi ke semua device
        $result = $this->firebaseService->sendToAll($title, $body, $data);
        
        Log::info('Notification sent result (sync)', ['result' => $result]);
    }
}
