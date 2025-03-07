<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function read(Notification $notification){

        $notification->update(['read_at' => now()]);
    }
}
