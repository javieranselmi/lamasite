<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'course_stage_id'];

    public function course_stage(){
        return $this->belongsTo("App\CourseStage");
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function scopeNotRelated($query){
        return $query->whereNull('course_stage_id');
    }
}
