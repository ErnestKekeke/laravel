<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class myappMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $username;
    public string $msg;

    /**
     * Create a new message instance.
     */
    public function __construct(string $username, string $msg)
    {
        $this->username = $username;
        $this->msg = $msg;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Myapp Mail', // your mail subject 
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // emails a folder inside your views
            // while message => message.blade.php inside your email folder
            view: 'emails.message', 
            with: [
                'username' => $this->username,
                'msg' => $this->msg,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
