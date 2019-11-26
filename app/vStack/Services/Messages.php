<?php

namespace App\vStack\Services;

class Messages
{
    public static function send($type, $message, $closeable = true)
    {
        session()->push('quick.alerts', (object) ["type" => $type, "message" => $message, "closeable" => $closeable]);
    }
}
