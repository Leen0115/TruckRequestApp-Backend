<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
{
    return response()->json([
        'notifications' => DatabaseNotification::latest()->take(1)->get()
    ]);
}
}