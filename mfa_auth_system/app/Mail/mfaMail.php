<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mfaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $fullname;
    public string $otp;
    public string $lr; // login or registration

    /**
     * Create a new message instance.
     */
    public function __construct(string $fullname, string $otp, string $lr)
    {
        $this->fullname = $fullname;
        $this->otp = $otp;
        $this->lr = $lr;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Multi factor Authentication OTP',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(

            view: 'emails.otp', 
            with: [
                'username' => $this->fullname,
                'otp' => $this->otp,
                'lr' => $this->lr,
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
