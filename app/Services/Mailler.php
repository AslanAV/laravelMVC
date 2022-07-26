<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class Mailler
{
    public function sendEmail(string $emailSubject): void
    {
        Mail::send('templates.email', [], function ($message) use ($emailSubject) {
            $message->to('hello@example.com')->subject($emailSubject);
        });
    }
}
