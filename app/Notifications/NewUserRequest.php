<?php
// app/Notifications/NewUserRequest.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRequest extends Notification
{
    use Queueable;

    private $userRequest;

    public function __construct($userRequest)
    {
        $this->userRequest = $userRequest;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new user request has been submitted.')
                    ->action('View Request', url('/admin/requests'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'userRequest' => $this->userRequest,
        ];
    }
}
