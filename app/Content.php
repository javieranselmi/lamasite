<?php

namespace App;

use App\Jobs\SendContentNotificationEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Content extends BaseModel
{
    use DispatchesJobs;
    protected static function boot()
    {
        parent::boot();

        static::created(function($content) {
            dispatch(new SendContentNotificationEmail($content));
        });
    }
}
