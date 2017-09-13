<?php

namespace App\Console;

use App\Jobs\SendCourseDateLimitEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $CoursesToFinishInTwoDays = \App\Course::lessThanTwoDays()->get();
            $CoursesToFinishInTenDays = \App\Course::lessThanTenDays()->get();
            $Courses = $CoursesToFinishInTwoDays->merge($CoursesToFinishInTenDays);
            $Users = \App\User::all();
            $AlertCourses = [];

            foreach($Users as $User){
                $UserFinishedCourses = $User->getFinishedCourses();
                $CoursesToAlert = $Courses->diff($UserFinishedCourses);
                if($CoursesToAlert->count() > 0){
                    foreach($CoursesToAlert as $Course){
                        if(!isset($AlertCourses[$Course->id]['model'])){
                            $AlertCourses[$Course->id]['model'] = $Course;
                        }
                        $AlertCourses[$Course->id]['users'][] = $User;
                    }
                }
            }

            foreach($AlertCourses as $Course){
                dispatch(new SendCourseDateLimitEmail($Course['users'], $Course['model']));
            }
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
