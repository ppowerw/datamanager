<?php

namespace Controllers;

class Frontend {

    private $pageInfo;
    private $pageObj;
    private $outputContent;

    public function init() {
        $this->pageInfo = $this->definePage();
        $this->pageObj = new \Entities\Page\Page($this->pageInfo);
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

}
