<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorAccountVerifyNotification extends Notification
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
            ->line('Your account has been created successfully.')
            ->line('Please use the button below to verify your account.')
            ->action('Verify Account', $this->data['url'])
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
