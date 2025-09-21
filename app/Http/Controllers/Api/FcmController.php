<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FcmController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Register FCM token
     */
    public function registerToken(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $success = $this->firebaseService->registerToken(
            $request->token,
            $request->userAgent(),
            $request->ip()
        );

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Token berhasil didaftarkan'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mendaftarkan token'
        ], 500);
    }

    /**
     * Unregister FCM token
     */
    public function unregisterToken(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $success = $this->firebaseService->unregisterToken($request->token);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Token berhasil dihapus'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus token'
        ], 500);
    }

    /**
     * Send test notification
     */
    public function sendTest(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $success = $this->firebaseService->sendToAll(
            $request->title,
            $request->body,
            ['type' => 'test']
        );

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi test berhasil dikirim'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengirim notifikasi test'
        ], 500);
    }
}