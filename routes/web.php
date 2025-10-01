<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JamaahTemplateController;
use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/jamaah/template/download', [JamaahTemplateController::class, 'download'])->name('jamaah.template.download');

// Invoice Routes
Route::get('/invoice/{pembayaran}/generate', [InvoiceController::class, 'generate'])->name('invoice.generate');
Route::get('/invoice/{pembayaran}/view', [InvoiceController::class, 'view'])->name('invoice.view');

// FCM API Routes
Route::prefix('api/fcm')->group(function () {
    Route::post('/register', [FcmController::class, 'registerToken']);
    Route::post('/unregister', [FcmController::class, 'unregisterToken']);
    Route::post('/test', [FcmController::class, 'sendTest']);
});
