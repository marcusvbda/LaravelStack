<?php

namespace marcusvbda\laravelstack\Services;

use Mail;

class SendMail
{

    public static function to($to, $subject, $html)
    {
        Mail::send([], [], function ($message) use ($to, $html, $subject) {
            $message->to($to)
                ->subject($subject)
                ->setBody($html, 'text/html');
        });
    }
}
