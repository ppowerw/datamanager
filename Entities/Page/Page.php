<?php

namespace Entities\Page;

class Page {
    
    // Config HTML Pages pathes
    private $cfgJSPath = '/HTML/Site/js/';
    private $cfgCSSPath = '/HTML/Site/css/';
    private $cfgTemplatePath = '/HTML/Site/templates/pages/';
    private $cfgModulesPath = '/HTML/Site/templates/modules/';
    
    private $pageInfo;
    private $templateModules;
    private $moduleList;
    
    public function __construct($data) {
        $this->pageInfo = $data;
        $this->pageTemplate = $this->loadTemplate();
        
        echo $this->pageTemplate;
        // Debug Page build
        echo PHP_EOL.'<hr> debug_backtrace Page:';
        var_dump($this);
        debug_backtrace();
    }
    
    private function loadTemplate(){
        $pagePath = $this->cfgTemplatePath . $this->pageInfo['pageTemplate'] . '.html';
        $templateData = new \Libs\HTMLParser;
        $output = $templateData->buildPage($pagePath, $this->cfgModulesPath);
        return $output;        
    }
    
    private function getModulesFromTemplate($data){
        // need return Modules list wih recursion 
        // May be implemented as class in Libs
        $modules = \Libs\HTMLParser::getModulesFromHTML($data);
        return $modules;
    }
}

