<?php

namespace App;

class Product extends Content
{

    protected $appends = ['visits', 'shares'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'product_category_id', 'product_subcategory_id', 'featured', 'thumb_id', 'photo_id', 'subtitle', 'share_count', 'components'];

    // Relationships
    public function product_category(){
        return $this->belongsTo('App\ProductCategory');
    }

    public function product_subcategory(){
        return $this->belongsTo('App\ProductSubcategory');
    }

    public function getVisitsAttribute(){
        return Metric::countByNameAndResource('visit', $this);
    }

    // Relationships
    public function thumb(){
        return $this->belongsTo('App\File');
    }

    public function photo(){
        return $this->belongsTo('App\File');
    }

    public function scopeFeatured($query){
        return $query->where('featured', true);
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function files()
    {
        return $this->belongsToMany('App\File');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function getSharesAttribute(){
        return Metric::countByNameAndResource("share", $this);
    }

    public function delete(){
        if($this->files->count() > 0){
            foreach($this->files as $relatedFile){
                $relatedFile->delete();
            }
        }

        parent::delete();
    }
}
