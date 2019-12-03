<?php

namespace App\vStack\Notifications;

use Illuminate\Notifications\Notification;

class Message extends Notification
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return $this->data;
    }
}
