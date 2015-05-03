<?php

namespace Libs;

class HTMLParser {

    private $modulesDirectory;

    // Build page from template including modules
    public function buildPage($pagePath, $modulesDirectory) {
        $this->modulesDirectory = $modulesDirectory;
        $pageTemplate = $this->loadTemplate($pagePath);
        $HTMLSource = preg_replace_callback('/(\{\{module:)(.+)(\}\})/', function($matches) {
            return $this->loadModule($matches[2]);
        }, $pageTemplate);
        return $HTMLSource;
    }

    // Load HTML template by link
    private function loadTemplate($link) { //link to html template
        ob_start();
        include($link);
        $template = ob_get_clean();
        ob_flush();
        return $template;
    }

    // Load module Template within function 'loadTemplate'
    private function loadModule($moduleName) {
        $templatePath = $this->modulesDirectory . $moduleName .'.html';
        $modTemplate = $this->loadTemplate($templatePath);
        return $modTemplate;
    }

}
