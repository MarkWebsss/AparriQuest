<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClaimRequestRejectedNotification extends Notification implements ShouldQueue
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Claim Request Has Been Rejected')
            ->greeting('Hello, ' . $notifiable->name)
            ->line('We regret to inform you that your claim request for the business "' . $this->claimRequest->business->businessName . '" has been rejected.')
            ->action('View Claim Requests', url('/owner/claim-requests'))
            ->line('You can reapply or contact support for more details.');
    }

    /**
     * Get the array representation of the notification for storage in the database.
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Claim Request Rejected',
            'message' => 'Your claim request for "' . $this->claimRequest->business->businessName . '" has been rejected.',
            'url' => url('/owner/claim-requests'),
        ];
    }
}
