<?php

namespace Controllers;

class API{

    public function init() {
        $email = \Libs\InputFilter::init()->getGlobal('email', 'POST');
        $outputContent = PHP_EOL . '<h3>For email: ' . $email . '</h3>'.PHP_EOL. '<p>Subscribe catch</p>' .PHP_EOL;
        echo $outputContent;
    }
    
    

}
