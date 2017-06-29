<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends BaseModel implements AuthenticatableContract
{
    use Authenticatable, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function courseStages() {
        return $this->belongsToMany('App\CourseStage', 'course_stage_user');
    }

    public function didCompleteStage($course_stage_id){
        return $this->courseStages()->wherePivot('course_stage_id', $course_stage_id)->get()->count() > 0;
    }

    public function getFinishedCourses(){
        $completedStages = $this->courseStages;
        $Courses = Course::whereIn('id', $completedStages->pluck('course_id'))->get();

        $FinishedCourses = [];

        foreach($Courses as $Course){
            $courseCompletedStages = $completedStages->filter(function($stage) use($Course){
                return $stage->course->id == $Course->id;
            });
            if($courseCompletedStages->count() == $Course->course_stages->count()){
                $FinishedCourses[] = $Course;
            }
        }

        return collect($FinishedCourses);
    }

    public function getPendingCourses(){
        $FinishedCourses = $this->getFinishedCourses();
        return \App\Course::withStages()->whereNotIn('id', $FinishedCourses->pluck('id'))->get();

    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }
}