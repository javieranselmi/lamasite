<?php

namespace App;

class ProductCategory extends Content
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'file_id'];

    // Relationships
    public function products(){
        return $this->hasMany("App\Product");
    }

    public function product_subcategories(){
        return $this->hasMany("App\ProductSubcategory");
    }

    // Relationships
    public function file(){
        return $this->belongsTo("App\File");
    }

    public function delete(){
        if(!is_null($this->file)) {
            $File = $this->file;
            $this->file()->dissociate();
            $this->save();
            $File->delete();
        }

        parent::delete();
    }
}
