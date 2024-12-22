<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClaimRequestApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $claimRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($claimRequest)
    {
        $this->claimRequest = $claimRequest;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Send email and store in the database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Claim Request Has Been Approved')
            ->greeting('Hello, ' . $notifiable->name)
            ->line('Congratulations! Your claim request for the business "' . $this->claimRequest->business->businessName . '" has been approved.')
            ->action('View Your Shop', url('/owner/dashboard'))
            ->line('Thank you for using our platform!');
    }

    /**
     * Get the array representation of the notification for storage in the database.
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Claim Request Approved',
            'message' => 'Your claim request for "' . $this->claimRequest->business->businessName . '" has been approved.',
            'url' => url('/owner/dashboard'),
        ];
    }
}
