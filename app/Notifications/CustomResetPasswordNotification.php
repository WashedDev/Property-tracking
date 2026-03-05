<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    // Receive the token when the notification is triggered
    public function __construct($token)
    {
        $this->token = $token;
    }

    // Tell Laravel we want to send this via Email ('mail')
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Build the email and point it to our custom Blade view
    public function toMail($notifiable)
    {
        // Generate the reset URL
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Your Ctech Systems Password')
            ->view('emails.reset-password', [
                'url' => $url,
                'user' => $notifiable
            ]);
    }
}