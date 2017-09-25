<?php

namespace App;

use Carbon\Carbon;

class Course extends Content
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'file_id', 'finish_date', 'image_url'];

    protected $dates = ['finish_date'];

    protected $appends = ['comments_count'];

    public function scopeLessThanTwoDays($query){
        return $query->has('course_stages')->where('finish_date', '>', new Carbon("now"))->where('finish_date', '<=', (new Carbon('now'))->addDays(2));
    }

    public function scopeLessThanTenDays($query){
        return $query->has('course_stages')->where('finish_date', '>', (new Carbon("now"))->addDays(9))->where('finish_date', '<=', (new Carbon('now'))->addDays(10));
    }

    // Relationships
    public function file(){
        return $this->belongsTo('App\File');
    }

    public function course_stages(){
        return $this->hasMany('App\CourseStage');
    }

    public function scopeWithStages($query){
        return $query->has('course_stages');
    }

    public function products(){
        return $this->belongsToMany('App\Product');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function getCommentsCountAttribute(){
        return Metric::countByNameAndResource("comment", $this);
    }

    public function delete(){
        try {  parent::delete(); } catch (\Exception $e) {\Log::info($e->getMessage(),['stak' => $e->getTraceAsString()]);};
    }
}
