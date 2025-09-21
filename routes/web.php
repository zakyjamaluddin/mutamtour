<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JamaahTemplateController;
use App\Http\Controllers\Api\FcmController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jamaah/template/download', [JamaahTemplateController::class, 'download'])->name('jamaah.template.download');

// FCM API Routes
Route::prefix('api/fcm')->group(function () {
    Route::post('/register', [FcmController::class, 'registerToken']);
    Route::post('/unregister', [FcmController::class, 'unregisterToken']);
    Route::post('/test', [FcmController::class, 'sendTest']);
});
