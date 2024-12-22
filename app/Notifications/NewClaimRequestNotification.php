<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewClaimRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $claimRequest;

    public function __construct($claimRequest)
    {
        $this->claimRequest = $claimRequest;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Email and Database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new claim request has been submitted.')
                    ->line('Business: ' . $this->claimRequest->business->businessName)
                    ->line('Request Details: ' . $this->claimRequest->details)
                    ->action('Review Request', url('admin/claim-request/' . $this->claimRequest->id)); // Update the URL to match your route
    }
    
    public function toDatabase($notifiable)
    {
        return [
            'claim_request_id' => $this->claimRequest->id,
            'business_name' => $this->claimRequest->business->businessName,
            'url' => url('admin/claim-request/' . $this->claimRequest->id), // Update the URL here as well
            'title' => 'New Claim Request for ' . $this->claimRequest->business->businessName,
            'message' => 'A new claim request has been submitted for ' . $this->claimRequest->business->businessName . '.',
        ];
    }
    

    // Convert notification data to an array format
    public function toArray($notifiable)
    {
        return [
            'claim_request_id' => $this->claimRequest->id,
            'business_name' => $this->claimRequest->business->businessName,
            'url' => url('/admin/claim-requests/' . $this->claimRequest->id),
            'title' => 'New Claim Request for ' . $this->claimRequest->business->businessName,  // Add title here
            'message' => 'A new claim request has been submitted for ' . $this->claimRequest->business->businessName . '.',
        ];
    }
}
