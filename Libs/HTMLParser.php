<?php

namespace Libs;

class HTMLParser {

    private $modulesDirectory;
    private $listModuleData =[];

    // Build page from template including modules
    public function initPageTemplate($pagePath, $modulesDirectory) {
        $this->modulesDirectory = $modulesDirectory;
        $content = $this->loadHTMLTemplate($pagePath);
        $HTMLSource = $this->findModuleInContent($content);
        return $HTMLSource;
    }
    
    // Load HTML template by link
    private function loadHTMLTemplate($link) { //link to html template
        ob_start();
        include($link);
        $template = ob_get_clean();
        ob_flush();
        // Init template dataset
        $this->initModuleData($template);
        return $template;
    }
    
    private function findModuleInContent ($content){
        $moduleRegexp = '/\{\{module:(.+)\}\}/';
            $HTMLSource = preg_replace_callback($moduleRegexp, function($matches) {
            return $this->loadModuleTemplate(ucfirst($matches[1]));
        }, $content);
        return $HTMLSource;
    }

    // Load module Template within function 'loadTemplate'
    private function loadModuleTemplate($moduleName) {
        $templatePath = $this->modulesDirectory . $moduleName .'.html';
        $moduleContent = $this->loadHTMLTemplate($templatePath);
        $HTMLSource = $this->findModuleInContent($moduleContent);
        return $HTMLSource;
    }
    
    private function initModuleData($content){
        $dataRegexp = '/\{\{(.+)\.(.+)\}\}/';
        preg_replace_callback($dataRegexp, function($matches) {
            //var_dump($matches,'}}}}}}');
            $this->listModuleData[ucfirst($matches[1])][ucfirst($matches[2])] = ucfirst($matches[2]);
        }, $content);
        return 1;
    }
    
    public function getModulesData(){
        return $this->listModuleData;
    }

}
