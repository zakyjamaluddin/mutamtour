<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
                'title' => 'Selamat Datang di Mutamtour',
                'body' => 'Sistem notifikasi telah aktif. Anda akan menerima pemberitahuan ketika ada perubahan data jamaah.',
                'type' => 'info',
                'data' => ['type' => 'welcome'],
                'is_read' => false,
            ],
            [
                'title' => 'Sistem Notifikasi Aktif',
                'body' => 'Notifikasi push telah dikonfigurasi dengan Firebase FCM. Semua perubahan data jamaah akan dikirim ke browser Anda.',
                'type' => 'success',
                'data' => ['type' => 'system'],
                'is_read' => false,
            ],
        ];

        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}
