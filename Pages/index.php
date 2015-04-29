<?php

namespace Pages;

class index{
    private $outputContent;

    public function initPage(){
        ob_start();
        include 'html\templates\index.html';
        $this->outputContent = ob_get_clean();
        return $this->outputContent;
    } 
    
}

