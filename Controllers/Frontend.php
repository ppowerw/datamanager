<?php

namespace Controllers;

class Frontend{
    
    // Config Frontend pathes
    private $jsPath       = 'HTML/Frontend/js/';
    private $cssPath      = 'HTML/Frontend/css/';
    private $templatePath = 'HTML/Frontend/templates/';

    private $outputContent;

    public function init(){
        ob_start();
        include $this->templatePath .'index.html';
        $this->outputContent = ob_get_clean();
        echo $this->outputContent;
    }
    
}

