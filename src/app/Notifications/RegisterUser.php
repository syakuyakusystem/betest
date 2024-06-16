<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;

class RegisterUser extends VerifyEmail
{
    use Queueable;

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
                ->subject('ユーザー登録')
                ->view('sample.registerUser', ['url' => $verificationUrl]);

    }

}