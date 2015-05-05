<?php

namespace Libs;

class InputFilter {

    private static $instance = null;
    protected $_globVars = [];

    public static function init() {
        if (is_null(self::$instance)) {
            self::$instance = new InputFilter();
        }
        return self::$instance;
    }

    private function __clone() {
        
    }

    private function __construct() {
        
    }

    public function getGlobal($name, $type = 'GET') {
        // Acceptable types: GET, POST, COOKIE, SERVER
        if (!isset($this->_globVars[$name])) {
            switch ($type) :
                case 'GET': $inType = INPUT_GET;
                    break;
                case 'POST': $inType = INPUT_POST;
                    break;
                case 'COOKIE': $inType = INPUT_COOKIE;
                    break;
                case 'SERVER': $inType = INPUT_SERVER;
                    break;
                default: $inType = INPUT_GET;
                    break;
            endswitch;
            $this->_globVars[$name] = strtolower((string) filter_input($inType, $name, FILTER_SANITIZE_ENCODED));
        }
        return $this->_globVars[$name];
    }

}
