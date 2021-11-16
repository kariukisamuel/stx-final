<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessfulPaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $emailBody;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailBody)
    {
        $this->emailBody = $emailBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Staxo Ecommerce Payment Notification')->view('mail.paymentConfirmation');
    }
}
