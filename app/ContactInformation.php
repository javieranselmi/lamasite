<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contact_information';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'phone_one', 'phone_two'];

}
