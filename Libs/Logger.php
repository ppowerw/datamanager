<?php

namespace Libs;

/* ------------------    
 * Description:
 * 1. For using method 'toFile':
 *    - You should set 'path' and 'filename' to log-file.
 *    - Script must can write into log-file.
 * 2. For using method 'toScreen':
 *    - You can set 'debugMode' to TRUE fore ENABLE screen output 
 */

class Logger {

    private static $instance = null;
    //Config log-file   
    private $pathToLog = 'logs/';
    private $filename = 'main.log';
    //Config toScreen method
    private $debugMode = 1;

    public static function doLog() {
        if (is_null(self::$instance)) {
            self::$instance = new Logger;
        }
        return self::$instance;
    }

    public function toFile($data) {
        file_put_contents($this->pathToLog . $this->filename, $this->buildLog($data) . PHP_EOL, FILE_APPEND);
    }

    public function toScreen($data) {
        if ($this->debugMode === 0) {
            return null;
        }
        ob_start();
        echo PHP_EOL . "<h6>" . $this->buildLog($data) . "</h6>" . PHP_EOL;
        ob_flush();
    }
    
    public function debug($data, $label ='') {
        if ($this->debugMode === 0) {
            return null;
        }
        var_dump("Dump for '" . $label , $data, "== End dump (" . $label . ")==" );
    }

    private function buildLog($data) {
        if (is_array($data)) {
            $logString = $this->parseArray($data);
        } else if(is_string($data)) {
            $logString = $data;
        }
        $logString = date("Y-m-d\ H:i:s") . ' - ' . $logString;
        return $logString;
    }

    private function parseArray($arr) {
        $data = '{Array: ';
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $data .= '[' . $key . ']: ';
                $data .= $this->parseArray($value);
            } else if (is_string($value)) {
                $data .= '[' . $key . ']: ' . $value . ', ';
            } else {
                $data .=  '((' . gettype($value) . '))';
            }
        }
        $data .= '} ';
        return $data;
    }

}
