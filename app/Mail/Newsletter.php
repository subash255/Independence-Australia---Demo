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

    public function __construct($subject, $content)
    {
        $this->subject = $subject;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->subject)  // Set the subject dynamically
                    ->view('emails.newsletter') // Assuming your view is in resources/views/emails/newsletter.blade.php
                    ->with([
                        'content' => $this->content, // Pass the content to the email view
                    ]);
    }
}
