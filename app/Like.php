<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends BaseModel
{
    protected $table = 'likes';

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function folder()
    {
        return $this->belongsTo('App\Folder');
    }

    //
}
