<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\TruckRequest;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(TruckRequest $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // نحفظه في جدول الإشعارات
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->order->status, // just the status
        ];
    }
}