<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $attachment;

    public function __construct($subject, $content, $attachment)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->attachment = $attachment;
    }

    public function build()
    {
        return $this->subject($this->subject) 
            ->view('emails.newsletter') 
            ->with([
                'content' => $this->content, 
                'attachment' => $this->attachment,
            ]);
    }
}
