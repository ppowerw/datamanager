<?php

namespace Pages;

class Subscribe {

    public function initPage() {
        $email = \Libs\InputFilter::getGlobal('email', 'POST');
        $outputContent = PHP_EOL . '<h3>For email: ' . $email . '</h3>'.PHP_EOL. '<p>Subscribe catch</p>' .PHP_EOL;
        return $outputContent;
    }

}
