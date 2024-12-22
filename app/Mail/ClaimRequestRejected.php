<?php
namespace App\Mail;

use App\Models\Owners\ClaimRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $claimRequest;

    public function __construct(ClaimRequest $claimRequest)
    {
        $this->claimRequest = $claimRequest;
    }

    public function build()
    {
        return $this->subject('Claim Request Rejected')
                    ->view('emails.claimRequestRejected') // You'll need to create this view.
                    ->with([
                        'businessName' => $this->claimRequest->business->businessName,
                        'userName' => $this->claimRequest->user->name,
                    ]);
    }
}

