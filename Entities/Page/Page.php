<?php

namespace Entities\Page;

class Page {

    // Config HTML Pages pathes
    private $cfgTemplatePath = '/HTML/Site/templates/pages/';
    private $cfgModulesPath = '/HTML/Site/templates/modules/';
    private $pageInfo;
    private $pageTemplate;
    private $pageParams;

    public function __construct($data) {
        $this->pageInfo = $data;
        $this->pageTemplate = $this->loadTemplate();
        
        //echo $this->pageTemplate;
        // Debug Page build
        echo PHP_EOL . '<hr> debug_backtrace Page:';
        debug_backtrace();
        var_dump($this, 'END Page ============');
        return $this;
    }
    
    public function getPageParams() {
        return $this->pageParams;
    }

    private function loadTemplate() {
        $pagePath = $this->cfgTemplatePath . $this->pageInfo['pageTemplate'] . '.html';
        $templateData = new \Libs\HTMLParser;
        $output = $templateData->initPageTemplate($pagePath, $this->cfgModulesPath);
        $this->pageParams = $templateData->getModulesData();
        return $output;
    }

    private function getModulesFromTemplate($data) {
        // need return Modules list wih recursion 
        // May be implemented as class in Libs
        $modules = \Libs\HTMLParser::getModulesFromHTML($data);
        return $modules;
    }
    
    public function renderPage($data) {
        // TBD need to replace defined data into $this->pageTemplate
        return $output;
    }
}
