<?php

namespace App\Mail;

use App\ResetPasswordToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $resetPasswordToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ResetPasswordToken $resetPasswordToken)
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset_password');
    }
}
