<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;


    public $name = "";
    public $email = "";
    public $contact_message = "";

    /**
     * Create a new message instance.
     *
     * @param $name
     * @param $email
     * @param $message
     */
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->contact_message = $message;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact',['name' => $this->name, 'email' => $this->email, 'contact_message' => $this->contact_message]);
    }
}
