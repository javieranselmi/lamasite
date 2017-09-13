<?php

namespace App;

class Post extends Content
{
    protected $appends = ['visits', 'shares', 'name', 'comments_count'];
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'description', 'share_count'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function getVisitsAttribute(){
        return Metric::countByNameAndResource('visit', $this);
    }

    public function getSharesAttribute(){
        return Metric::countByNameAndResource("share", $this);
    }

    public function getCommentsCountAttribute(){
        return Metric::countByNameAndResource("comment", $this);
    }

    public function getNameAttribute(){
        return $this->title;
    }

    public function delete(){
        if(!is_null($this->file))
            $this->file->delete();

        parent::delete();
    }

    //
}
