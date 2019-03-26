<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationToFreelancer extends Mailable
{
    use Queueable, SerializesModels;
    private $details;
    private $freelancer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $freelancer)
    {
        $this->details = $details;
        $this->freelancer = $freelancer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.username'))
            ->markdown('emails.freelance', [
                'details' => $this->details,
                'freelancer' => $this->freelancer
            ])
            ->subject('Your proposal accepted');
    }
}
