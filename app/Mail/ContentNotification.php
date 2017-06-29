<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContentNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $contentType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contentType)
    {
        $this->contentType = $contentType;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.content_notification',['content_type' => $this->contentType]);
    }
}
