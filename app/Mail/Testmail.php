<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Testmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name = "";
    public $email = "";
    public $subject = "";
    public $msg = "";

    public function __construct($name,$email,$subject,$msg)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->msg = $msg;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $final_name = $this->name;
        $final_email = $this->email;
        $final_subject = $this->subject;
        $final_msg = $this->msg;
        return $this->view('mail.email',compact('final_name', 'final_email', 'final_subject', 'final_msg'));
    }
}
