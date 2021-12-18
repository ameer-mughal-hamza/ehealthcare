<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorAccountVerifiedNotification extends Notification
{
    use Queueable;
    private $data;

    public function __construct($display)
    {
        $this->data = $display;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your account has been activated successfully.')
            ->line('Now you can use your account.')
            ->action('Go to Dashboard', $this->data['url'])
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
