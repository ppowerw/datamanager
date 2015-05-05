<?php

namespace Controllers;

class Frontend {

    private $modelsPath = '\Entities\\';

    private $pageInfo;
    private $pageObj;
    private $models;
    private $pageData;
    private $outputContent;

    public function init() {
        
        // TBD As need to redesign:
        // 1. Define page template (this)
        // 2. Get template with modules (View) -extract from "Page"
        // 2.1. Get HTML Content (View)
        // 2.2. Get Modules data from template (View )
        // 3. Init models for modules (Models)
        // 4. Get data from Models for HTML content (Models)
        // 5. Parse HTML content with Data (View render)
        
        $this->pageInfo = $this->definePage();
        $this->pageObj = new \Entities\Page\Page($this->pageInfo);
        $this->models = $this->initPageModel($this->pageObj->getPageParams());
        var_dump('$this->models===', $this->models ,'===========');
        foreach ($this->pageObj->getPageParams() as $key => $value) {
            $this->pageData[$key] = $this->getModelData($key, $value);
            var_dump('===$this->pageData[$dataSetName]====', $this->pageData[$key], '===============');
        }
        
         
        $this->outputContent = \Views\ViewHTML::renderContent($this->pageObj->getPageTemplate(),$this->pageData);
        echo $this->outputContent;
    }

    private function definePage() {
        //Prepare URI path for search
        $searchPage = explode("%2f", substr(\Core\App::getInstance()->route, 0, 100))[1];
        if (strpos($searchPage, ".")) {
            $searchPage = substr($searchPage, 0, strpos($searchPage, "."));
        }
        //Search page in SiteTree
        $listPages = \Entities\SiteTree\SiteTree::getSiteTreeColumn('url');
        $result = array_search($searchPage, $listPages);
        if (is_bool($result)) {
            echo '(404) Didn\'t FOUND PAGE ' . $searchPage;
            // Need to add 404 page
            die();
            return null;
        }
        return \Entities\SiteTree\SiteTree::getSiteTreePage((string)$result);
    }
    
    // Create models for 
    private function initPageModel($data){
        foreach ($data as $key => $value){
            $modelPath = $this->modelsPath . $key .'\\'. $key;
            $data[$key] = new $modelPath($value);
        }
        return $data;
    }
    
    private function getModelData ($model, $params){
        var_dump('$model>>>', $model, '===;');
        var_dump('$params>>>', $params, '===;');
        $modelData=[];
        foreach ($params as $value){
            $modelData[$value] = $this->models[$model]->getData($value);
        }
        return $modelData;
    }
}
