<?php

namespace Core;

class Application {

    private $route;
    private $controller;
    private $GETParams = [];

    public function initApp() {
        $this->route = $this->parseURL();
        $this->GETParams = $this->parseGETParams($this->route);
        xdebug_var_dump('>>>route: ', $this->route);
        $controllerName = $this->getController($this->route);
        $this->controller = $this->initController($controllerName);
    }

    private function parseUrl() {
        // Set $routepath by URL
        $urlParse = parse_url(\Libs\InputFilter::init()->getGlobal('REQUEST_URI', 'SERVER'));
        $path = substr($urlParse['path'], 0, 240); //TBD - URI limits
        return $path;
    }

    private function parseGETParams($url) {
        // Set $GETParams, if contains
        if (strpos($url, "%3f")) {
            $$url = substr($url, 0, strpos($url, "%3f"));
            $params = $this->parseQueryString(substr($url, strpos($url, "%3f") + 3));
            return $params;
        } else {
            return null;
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

    private function getController($path) {
        $route = explode("%2f", substr($path, 0, 100));
        if (isset($route[1])) {
            if (strpos($route[1], ".")) {
                $route[1] = substr($route[1], 0, strpos($route[1], "."));
            }
            return strtolower($route[1]);
        } else {
            return 'index'; //Set default link
        }
    }

    private function initController($name) {
        switch ($name) {
            case 'api':
                $label = 'API';
                break;
            case 'cpanel':
                $label = 'CPanel';
                break;
            case 'index':
            default:
                $label = 'Frontend';
                break;
        }
        $controllerPath = '\Controllers\\' . $label;
        $this->controller = new $controllerPath;
        $this->controller->init();
    }
}
