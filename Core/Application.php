<?php

namespace Core;

class Application {

    private $route = [];
    private $page;
    private $URIpath;
    private $GETParams;
    private $POSTparams;
    private $HTMLsource;

    public function initApp() {
        $this->parseRoute();
        xdebug_var_dump('>>>route: ', $this->route);
        $this->initPage();
        echo $this->HTMLsource;
    }

    private function parseRoute() {
        $this->route['page'] = $this->parseUrl();
        return 0;
    }

    private function parseUrl() {
        $urlParse = parse_url(\Libs\InputFilter::init()->getGlobal('REQUEST_URI', 'SERVER'));
        $url = $urlParse['path'];
        if (strpos($url, "%3f")) {
            $path = substr($url, 0, strpos($url, "%3f"));
            $this->GETParams = $this->parseQueryString(substr($url, strpos($url, "%3f") + 3));
        } else {
            $path = $url;
        }
        $this->URIpath = explode("%2f", substr($path, 0, 250));
        if (isset($this->URIpath[1])) {
            if (strpos($this->URIpath[1], ".")) {
                $this->URIpath[1] = substr($this->URIpath[1], 0, strpos($this->URIpath[1], "."));
            }
            return $this->URIpath[1];
        } else {
            return 'index'; //Set default page
        }
    }

    private function parseQueryString($str) {
        $arrStr = explode("%26", $str); //%26  %3d
        foreach ($arrStr as $value) {
            $param = explode("%3d", $value);
            $arr[$param[0]] = $param[1];
        }
        return $arr;
    }

    private function initPage() {
        switch ($this->route['page']) {
            case 'index':
                $pagePath = '\Pages\index';
                break;
            case 'api':
                $pagePath = '\Pages\API\\' . $this->URIpath[2];
            case 'index':
            default:
                $pagePath = '\Pages\index';
                break;
        }
        $this->page = new $pagePath;
        $this->HTMLsource = $this->page->initPage();
        return $this->HTMLsource;
    }

}
