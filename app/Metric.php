<?php

namespace App;

class Metric extends BaseModel
{
    protected $table = 'metrics';
    protected $fillable = ['name', 'type', 'value', 'user_id', 'resource_type', 'resource_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function resource(){
        if (!is_null($this->resource_type)){
            $class = new \ReflectionClass($this->resource_type);
            $instance = $class->newInstanceWithoutConstructor();
            return $instance->find($this->resource_id);
        }
        return null;
    }

    public static function counterByName($name, $groupBy='user_id', $sortBy='created_at'){
        return self::where('type', 'counter')->where('name', $name)->get()->sortBy($sortBy)->groupBy($groupBy);
    }


    public static function countByNameAndResource($name, $resource){
        return self::where('type', 'counter')
                     ->where('name', $name)
                     ->where('resource_type', get_class($resource))
                     ->where('resource_id', $resource->id)->count();
    }
}
