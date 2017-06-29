<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseDateLimit extends Mailable
{
    use Queueable, SerializesModels;


    protected $limitText;
    protected $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($limitText, $course)
    {
        $this->limitText = $limitText;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.course_date_limit',['course' => $this->course, 'limitText' => $this->limitText]);
    }
}
