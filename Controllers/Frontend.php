<?php

namespace Controllers;

class Frontend {

    private $modelsPath = '\Entities\\';

    private $pageInfo;
    private $pageObj;
    private $pageData;
    private $outputContent;

    public function init() {
        $this->pageInfo = $this->definePage();
        $this->pageObj = new \Entities\Page\Page($this->pageInfo);
        $this->pageData = $this->initPageModel($this->pageObj->getPageParams());
        var_dump('$this->pageData===', $this->pageData ,'===========');
        $this->outputContent = $this->pageObj->render($this->pageData);
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
            $modelPath = $this->modelsPath . ucwords($key) .'\\'. $key;
            $data[$key] = new $modelPath($value);
        }
        return $data;
    }
}
