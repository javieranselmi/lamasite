<?php
/**
 * Created by PhpStorm.
 * User: nacho
 * Date: 31/03/2017
 * Time: 23:00
 */
namespace App\Mail;

use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShareFile extends  Mailable
{
    use Queueable, SerializesModels;


    public $file;
    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(File $file, $comment)
    {
        $this->file = $file;
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
        return $this->view('emails.shareFile',['file' => $this->file, 'comment' => $this->comment]);
    }
}
