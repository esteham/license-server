<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LicenseCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $code;
    public string $name;

    public function __construct(string $code, string $name ='Customer')
    {
        $this->code = $code;
        $this->name = $name;

    }

    public function build()
    {
        return $this->subject('Your License Code')->view('mails.license-code');
    }

}
