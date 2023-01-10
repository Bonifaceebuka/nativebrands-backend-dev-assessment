<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Mails\ForgottenPasswordMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgottenPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verify your Finrik Account')
        ->view('welcome')
        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'),);
        //return $this->view('emails.new-contact-message');
    }
}
