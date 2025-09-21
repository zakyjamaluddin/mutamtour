<?php

namespace App\Services;

use App\Models\FcmToken;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        // Firebase akan diinisialisasi ketika diperlukan
        $this->messaging = null;
    }

    private function initializeFirebase()
    {
        if ($this->messaging === null) {
            try {
                $factory = (new \Kreait\Firebase\Factory)
                    ->withServiceAccount(config('firebase.service_account'));

                $this->messaging = $factory->createMessaging();
            } catch (\Exception $e) {
                Log::error('Failed to initialize Firebase: ' . $e->getMessage());
                $this->messaging = false;
            }
        }
        return $this->messaging;
    }

    /**
     * Send notification to all registered FCM tokens
     */
    public function sendToAll($title, $body, $data = [])
    {
        try {
            $tokens = FcmToken::pluck('token')->toArray();
            
            if (empty($tokens)) {
                Log::info('No FCM tokens found');
                return false;
            }

            $messaging = $this->initializeFirebase();
            if (!$messaging) {
                Log::error('Failed to initialize Firebase');
                return false;
            }

            $message = \Kreait\Firebase\Messaging\CloudMessage::new()
                ->withNotification(\Kreait\Firebase\Messaging\Notification::create($title, $body))
                ->withData($data)
                ->withWebPushConfig(\Kreait\Firebase\Messaging\WebPushConfig::fromArray([
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                        'icon' => '/favicon.ico',
                        'badge' => '/favicon.ico',
                    ]
                ]));

            $result = $messaging->sendMulticast($message, $tokens);

            // Save notification to database
            Notification::create([
                'title' => $title,
                'body' => $body,
                'type' => 'info',
                'data' => $data,
            ]);

            Log::info('Firebase notification sent successfully', [
                'success_count' => $result->successes()->count(),
                'failure_count' => $result->failures()->count(),
            ]);

            return $result;

        } catch (\Exception $e) {
            Log::error('Firebase notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send notification to specific FCM tokens
     */
    public function sendToTokens($tokens, $title, $body, $data = [])
    {
        try {
            if (empty($tokens)) {
                return false;
            }

            $messaging = $this->initializeFirebase();
            if (!$messaging) {
                Log::error('Failed to initialize Firebase');
                return false;
            }

            $message = \Kreait\Firebase\Messaging\CloudMessage::new()
                ->withNotification(\Kreait\Firebase\Messaging\Notification::create($title, $body))
                ->withData($data)
                ->withWebPushConfig(\Kreait\Firebase\Messaging\WebPushConfig::fromArray([
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                        'icon' => '/favicon.ico',
                        'badge' => '/favicon.ico',
                    ]
                ]));

            $result = $messaging->sendMulticast($message, $tokens);

            Log::info('Firebase notification sent to specific tokens', [
                'token_count' => count($tokens),
                'success_count' => $result->successes()->count(),
                'failure_count' => $result->failures()->count(),
            ]);

            return $result;

        } catch (\Exception $e) {
            Log::error('Firebase notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Register FCM token
     */
    public function registerToken($token, $userAgent = null, $ipAddress = null)
    {
        try {
            FcmToken::updateOrCreate(
                ['token' => $token],
                [
                    'user_agent' => $userAgent,
                    'ip_address' => $ipAddress,
                    'last_used_at' => now(),
                ]
            );

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to register FCM token: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Unregister FCM token
     */
    public function unregisterToken($token)
    {
        try {
            FcmToken::where('token', $token)->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to unregister FCM token: ' . $e->getMessage());
            return false;
        }
    }
}
