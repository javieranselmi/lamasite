<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends BaseModel
{
    protected $table = 'events';
    protected $fillable = ['title', 'description', 'event_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
