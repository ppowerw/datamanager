<?php
namespace Views;

class ViewHTML{
        
    public static function renderContent($HTMLcontent /*Replacement content by template: {{key.value}}*/, $dataSet /* Data array for replacing by 'key' in ASSOC array*/){
        //// \Libs\Logger::doLog()->debug($dataSet, 'Rendering $dataSet: ');
        foreach ($dataSet as $model => $dataArr) {
            foreach ($dataArr as $key => $value) {
               $replacement = "/{{" . $model. "." . $key. "}}/";
            //// \Libs\Logger::doLog()->debug($replacement . '-> ' .$value, "Parse data: ");
            $HTMLcontent = preg_replace($replacement, $value,$HTMLcontent);
            }
        }
        //// \Libs\Logger::doLog()->debug($HTMLcontent, '$HTMLcontent');
        return $HTMLcontent;
    }
    
    public static function setModuleBorder($content, $moduleName =''){
        $replacement = "/{!Module:(.*)!}/";
        // Set moduleBox CSS style:
        //Border:
        $width = '1px';
        $color = '#fc6666';
        $style = 'solid';
        $labelColor = $color;
        
        $openBox = '<div class="moduleBox" style="border-width:' . $width . ';border-color:' . $color . ';border-style:' .$style . '">' .PHP_EOL;
        $openBox .= '<h6><font color="' . $labelColor . '">Module: ' . $moduleName . '</font></h6>' . PHP_EOL;
        $HTML = preg_replace($replacement, $openBox, $content);
        $HTML .= PHP_EOL . '</div>'; 
        return $HTML;
    }
}

