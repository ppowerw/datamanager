<?php
namespace Views;

class ViewHTML{
        
    public static function renderContent($HTMLcontent /*Replacement content by template: {{key.value}}*/, $dataSet /* Data array for replacing by 'key' in ASSOC array*/){
        var_dump('======$dataSet:=====', $dataSet , '==================');
        
        //var_dump('====== {{Site.Path}} ->:=====', $dataSet['Site']['Path'] , '==================');
        
        foreach ($dataSet as $model => $dataArr) {
            foreach ($dataArr as $key => $value) {
               $replacement = "/{{" . $model. "." . $key. "}}/";
            var_dump("====== Parse data: " .$replacement, "==================");
            $outputHTML = preg_replace($replacement, $value,$HTMLcontent);
            }
        }
        //var_dump('$HTMLcontent>>>>>>', $HTMLcontent);
        var_dump('$outputHTML>>>>>>', $outputHTML);
        return $outputHTML;
    }
}

