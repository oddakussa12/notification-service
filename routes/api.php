<?php

use Illuminate\Http\Request;

use App\Http\Controllers\SocketsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\JobNotificationController;
use App\Http\Controllers\HomeController;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// PUBLIC ROUTES
// auth routes
Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');

Route::post("/sockets/connect", [SocketsController::class, "connect"]);


Route::post('/sendNotification', [NotificationController::class, "sendNotification"]);
Route::post('/markAsRead', [NotificationController::class, "markNotificationAsRead"]);
Route::post('/markAllAsRead', [NotificationController::class, "markAllNotificationsAsRead"]);
Route::get('/userNotification/{user_id}', [NotificationController::class, "userNotification"]);


Route::post('/sendJobPreferenceNotification', [JobNotificationController::class, "sendJobPreferenceNotification"]);
