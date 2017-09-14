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

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $model = $query->create($attributes);
        return $model;
    }

    public function getFileContent(){

    }

    public function getUrlAttribute()
    {
        return $this->file_name;
    }

    public function getPathAttribute()
    {
        return $this->file_name;
    }

    public function delete(){

    }
}
