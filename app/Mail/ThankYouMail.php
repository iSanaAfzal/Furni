<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $customerEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank You for Your Purchase')
                    ->text('emails.thankyou_plain');
    }
}