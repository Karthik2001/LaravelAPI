<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Messaging extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $senderFirstName, $senderLastName,$senderEmail,$senderSubject,$senderMessage;
    public function __construct($senderFirstName, $senderLastName,$senderEmail,$senderSubject,$senderMessage)
    {
        $this->senderFirstName = $senderFirstName;
        $this->senderLastName = $senderLastName;
        $this->senderEmail = $senderEmail;
        $this->senderSubject = $senderSubject;
        $this->senderMessage = $senderMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->senderEmail)->view('welcome');
    }
}
