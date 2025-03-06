<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;
    public $replyToEmail;

    public function __construct($subject, $messageContent, $replyToEmail)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
        $this->replyToEmail = $replyToEmail;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->replyTo($this->replyToEmail)
                    ->view('emails.bulk')->with([
                        'messageContent' => $this->messageContent,
                    ]);
    }
}
