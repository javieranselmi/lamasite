<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStage extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course_stages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = ['name', 'description', 'duration_in_minutes', 'type', 'html', 'json_vid_ppt', 'ppt_id', 'video_id', 'course_id'];
=======
    protected $fillable = ['name', 'description', 'duration_in_minutes', 'type', 'html', 'json_vid_ppt', 'ppt_id', 'video_id', 'course_id','ppt_url','video_url'];
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f

    // Relationships
    public function ppt(){
        return $this->belongsTo("App\File", "ppt_id");
    }

    public function video(){
        return $this->belongsTo("App\File", "video_id");
    }

    public function questions(){
        return $this->hasMany("App\Question");
    }

    public function course(){
        return $this->belongsTo("App\Course");
    }

    public function delete(){
        if(!is_null($this->ppt))
            $this->ppt->delete();
        if(!is_null($this->video))
            $this->video->delete();

        parent::delete();
    }
}
