<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    protected $table = 'comments';
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    //
}
