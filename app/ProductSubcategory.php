<?php

namespace App;

class ProductSubcategory extends Content
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_subcategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'product_category_id'];

    // Relationships
    public function products(){
        return $this->hasMany("App\Product");
    }

    // Relationships
    public function product_category(){
        return $this->belongsTo("App\ProductCategory");
    }
}
