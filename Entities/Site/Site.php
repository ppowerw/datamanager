<?php

namespace Entities\Site;

class Site {

    private $title ='That title';
    private $path ='/HTML/Site';
    
    public function __construct($params) {
        $this->setData();
    }
   
    public function getData($value) {
        $prop = lcfirst($value);
        if (property_exists($this,$prop)){
            return $this->$prop;
        }
        return null;
    }

    private function setData(){
        //$this->value = 'SERVER_PROTOCOL'
        // $this->path =  '/' . \Libs\InputFilter::init()->getGlobal('SERVER_NAME', 'SERVER') . '/' . $this->path;
    }
}
