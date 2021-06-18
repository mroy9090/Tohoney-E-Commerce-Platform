<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillingStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $message_about_billing_registration = "";
    public function __construct($message)
    {
        $this->message_about_billing_registration = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message_for_billing = $this->message_about_billing_registration;
        return $this->view('mail.billing_status',compact('message_for_billing'));
    }
}
