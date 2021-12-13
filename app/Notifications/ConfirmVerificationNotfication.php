<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmVerificationNotfication extends Notification
{
    use Queueable;

    private $data;

    public function __construct($display)
    {
        $this->data = $display;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Email Verified')
            ->line('Your email has been verified successfully.')
            ->line('Thank you for using our application!')
            ->action('Go to Home', url('/home'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
