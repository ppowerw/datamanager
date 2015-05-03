<?php
namespace Views;

class ViewHTML{
    
    public static function getModulesFromContent(){
        
    }
    
    public static function parseContent(){
        
    }
    
    public static function renderContent(){
        
    }
    
     /*   private function loadHTMLTemplate($name, $varList) {
        ob_start();
        include($this->path . $name. '.html');
        $output = ob_get_clean();
        $this->outputData = $this->parseModuleParams($output,$varList);
        ob_flush();
    }
    
    private function parseModuleParams($output,$varList){
        foreach ($varList as $key => $value) {
            $data = str_replace("{{" . $key . "}}", $value, $output);
        }
        return $data;
    }
      
      */
    
}

