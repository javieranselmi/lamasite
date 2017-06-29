<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Folder extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'folder_name', 'folder_id'];

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

    public static function create(array $attributes = [])
    {
        if(isset($attributes['name'])){
            $attributes['folder_name'] = str_slug($attributes['name'], "_");
        }
        $query = static::query();
        $model = $query->create($attributes);

        $parentFolder = '';
        if(isset($attributes['folder_id']) && $Folder = \App\Folder::find($attributes['folder_id'])){
            $parentFolder = static::getAllParentsFromFolder($Folder->id);
        }

        Log::info("About to create new directory: " . $parentFolder . $attributes['folder_name']);
        Storage::disk(env("APP_STORAGE"))->makeDirectory($parentFolder . $attributes['folder_name']);
        return $model;
    }

    public function folders(){
        return $this->hasMany('App\Folder');
    }

    public function parentFolder(){
        return $this->belongsTo('App\Folder', 'folder_id');
    }

    public function files(){
        return $this->hasMany('App\File');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function save(array $options = array())
    {
        $parentFolder = '';
        if($this->parentFolder){
            $parentFolder = static::getAllParentsFromFolder($this->parentFolder->id);
        }

        $folderNameChanged = $this->isDirty("name");
        if($folderNameChanged && $this->getOriginal("folder_name") != ""){
            $this->folder_name = str_slug($this->name, "_");
            Log::info("About to 'rename' folder: ".$this->getOriginal("folder_name").". creating new directory: " . $parentFolder . $this->folder_name);
            Storage::disk(env("APP_STORAGE"))->makeDirectory($parentFolder . $this->folder_name);
            foreach($this->files as $FileToMove){
                Storage::disk(env("APP_STORAGE"))->put($parentFolder . $this->folder_name . '/' . $FileToMove->file_name,  $FileToMove->getFileContent());
            }
            Storage::disk(env('APP_STORAGE'))->deleteDirectory($parentFolder . $this->getOriginal("folder_name"));
        }

        parent::save();

    }

    public function delete(){
        foreach($this->files as $File){
            $File->folder()->dissociate();
            $File->save();
            $File->delete();
        }

        foreach($this->folders as $folder){
            $folder->delete();
        }

        $parentFolder = '';
        if($this->parentFolder){
            $parentFolder = static::getAllParentsFromFolder($this->parentFolder->id);
            $this->parentFolder()->dissociate();
            $this->save();
        }
        Log::info("About to delete: " . $parentFolder . $this->folder_name);
        Storage::disk(env('APP_STORAGE'))->deleteDirectory($parentFolder . $this->folder_name);
        parent::delete();
    }
}
