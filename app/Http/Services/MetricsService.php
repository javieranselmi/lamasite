<?php

namespace App\Http\Services;

class MetricsService
{
    public function __construct(){
    }

    public function publishCounterWithValue($name, $value, $user){
        return $this->publishMetric($name, $value, 'counter', null, null, $user);
    }

    public function publishUserLogin($user){
        return $this->publishMetric('login', null, 'counter', null, null, $user);
    }

    public function publishResourceVisit($resource, $user){
        return $this->publishCounterWithResource("visit", $resource, $user);
    }

    public function publishCounterWithResource($name, $resource, $user){
        return $this->publishMetricWithResource($name, null, "counter", $resource, $user);
    }

    public function publishMetricWithResource($name, $value, $type, $resource, $user){
        if(!is_null($resource)){
            return $this->publishMetric($name, $value, $type, get_class($resource), $resource->id, $user);
        }
    }

    public function publishMetric($name, $value, $type, $resourceType, $resourceId, $user){
        return \App\Metric::create(['name' => $name, 'type' => $type, 'value' => $value, 'resource_type' => $resourceType, 'resource_id' => $resourceId, 'user_id' => $user->id]);
    }
}
