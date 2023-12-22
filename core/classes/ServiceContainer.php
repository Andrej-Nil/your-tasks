<?php

namespace classes;

class ServiceContainer
{

    protected $services = [];


    public function setServices($services, $func)
    {
        $this->services[$services] = $func;
    }


    public function getService($services)
    {
        if(!isset($this->services[$services])){
            throw new \Exception("Not found service {$services}");
        }
        return call_user_func($this->services[$services]);
    }

}