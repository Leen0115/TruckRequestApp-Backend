<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TruckRequestController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\NotificationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/truck-requests', [TruckRequestController::class, 'allRequests']);
Route::post('/send-email', [EmailController::class, 'send']); // ارسال ايميل للمستخدم
Route::put('/truck-requests/{id}/update-status', [TruckRequestController::class, 'updateStatus']);

Route::get('/notifications', [NotificationController::class, 'index']);
Route::delete('/notifications/{id}', function ($id) {
    \Illuminate\Notifications\DatabaseNotification::find($id)?->delete();
    return response()->json(['message' => 'Notification deleted']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/truck-requests', [TruckRequestController::class, 'store']);
    Route::get('/my-requests', [TruckRequestController::class, 'myRequests']); // حيرجع الطلبات الخاصة بالمستخدم اللي معاه التوكن
    Route::post('/cancel-request/{id}', [TruckRequestController::class, 'cancel']);
});

