<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    protected $appends = ['url', 'downloads'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_name_original', 'file_name', 'mime', 'folder_id'];

    private static function getAllParentsFromFolder($folder_id){
        $stop = true;
        $parentFolders = '';
        while($stop){
            $Folder = \App\Folder::find($folder_id);
            if($Folder == null){
                $stop = false;
            }
            $parentFolders = $Folder->folder_name . "/" . $parentFolders;
            if($Folder->parentFolder){
                $folder_id = $Folder->parentFolder->id;
            }else{
                $stop = false;
            }
        }
        return $parentFolders;
    }

    public function folder(){
        return $this->belongsTo('App\Folder');
    }

    public function getDownloadsAttribute(){
        return Metric::countByNameAndResource("download", $this);
    }

<<<<<<< HEAD
    public static function create(array $attributes = [])
    {
=======
    public static function create(array $attributes = [], $fileContents)
    {
        $parentFolder = '';
        if(isset($attributes['folder_id']) && $Folder = \App\Folder::find($attributes['folder_id'])){
            $parentFolder = static::getAllParentsFromFolder($Folder->id);
        }


        Storage::disk(env("APP_STORAGE"))->put($parentFolder . $attributes['file_name'],  $fileContents);
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        $query = static::query();
        $model = $query->create($attributes);
        return $model;
    }

    public function getFileContent(){
<<<<<<< HEAD

=======
        $parent = '';
        if($this->folder)
            $parent = static::getAllParentsFromFolder($this->folder->id);
        return Storage::disk(env("APP_STORAGE"))->get($parent . $this->attributes['file_name']);
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
    }

    public function getUrlAttribute()
    {
<<<<<<< HEAD
        return $this->file_name;
=======
        $parent = '';
        if($this->folder)
            $parent = static::getAllParentsFromFolder($this->folder->id);
        return Storage::disk(env('APP_STORAGE'))->url($parent . $this->attributes['file_name']);
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
    }

    public function getPathAttribute()
    {
<<<<<<< HEAD
        return $this->file_name;
    }

    public function delete(){

=======
        $parent = '';
        if($this->folder)
            $parent = static::getAllParentsFromFolder($this->folder->id);
        return $parent . $this->attributes['file_name'];
    }

    public function delete(){
        $parentFolder = '';
        if($this->folder){
            $parentFolder = static::getAllParentsFromFolder($this->folder->id);
        }

        Storage::disk(env('APP_STORAGE'))->delete($parentFolder . $this->file_name);
        parent::delete();
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
    }
}
