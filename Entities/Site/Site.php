<?php

namespace Entities\Site;

class Site {

    private $path;
    private $cfgJSPath = '/HTML/Site/js/';
    private $cfgCSSPath = '/HTML/Site/css/';
    
    public function __construct($params) {
        $this->setData();
    }
    
    public function getData($value) {
        if (!$this->$value){
            return $this->$value;
        }
        return null;
    }
    
    private function setData(){
        $this->path = parse_url(\Libs\InputFilter::init()->getGlobal('REQUEST_URI','SERVER'))['path'];
    }
}
