<?php

namespace App\Jobs;

use App\Content;
use App\Mail\ContentNotification;
use App\Mail\CourseDateLimit;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCourseDateLimitEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $course;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $course)
    {
        $this->users = $users;
        $this->course = $course;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now = new Carbon("now", "America/Argentina/Buenos_Aires");
        $diffInDays = $now->diffInDays($this->course->finish_date);

        Mail::bcc($this->users)->send(new CourseDateLimit($diffInDays . " dias", $this->course));
    }
}
