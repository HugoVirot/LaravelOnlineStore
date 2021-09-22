<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistrationCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $url = '127.0.0.1:8000';

    /**
     * The user who will receive the email.
     */

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()  // configuration options mail (form / subject / view / attach)
    {
        return $this
            ->subject('inscription réussie à Laravel Online Store')
            ->markdown('emails.registration');
    }
}
