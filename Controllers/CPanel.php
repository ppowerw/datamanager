<?php

namespace Controllers;

class CPanel{
    
    private $outputContent;

    public function init(){
        ob_start();
        echo '<h4>CPanel</h4><hr>' . PHP_EOL;
        $this->outputContent = ob_get_clean();
        echo $this->outputContent;
    } 
    
}




