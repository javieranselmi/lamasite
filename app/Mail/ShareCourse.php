<?php
/**
 * Created by PhpStorm.
 * User: nacho
 * Date: 31/03/2017
 * Time: 23:00
 */
namespace App\Mail;

use App\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShareCourse extends  Mailable
{
    use Queueable, SerializesModels;


    public $course;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Course $course, $comment)
    {
        $this->course = $course;
        $this->comment = $comment;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.shareCourse',['course' => $this->course, 'comment' => $this->comment]);
    }
}
