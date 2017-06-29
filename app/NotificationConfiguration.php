<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationConfiguration extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications_configurations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'display_name'];

}
