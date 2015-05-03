<?php

namespace Entities\SiteTree;

class SiteTree {

    private static $siteTree = [
        '0' => [
            'label' => 'Home',
            'parentId' => 0,
            'url' => 'index',
            'hasOwnTree' => 0,
            'pageTemplate' => 'Home'],
        '1' => [
            'label' => 'Catalog',
            'parentId' => 0,
            'url' => 'catalog',
            'hasOwnTree' => 1,
            'pageTemplate' => 'Catalog'],
        '2' => [
            'label' => 'Info',
            'parentId' => 0,
            'url' => 'info',
            'hasOwnTree' => 1,
            'pageTemplate' => 'InfoArticle'],
        '3' => [
            'label' => 'About',
            'parentId' => 0,
            'url' => 'about',
            'hasOwnTree' => 0,
            'pageTemplate' => 'About'],
    ];

    public static function getSiteTree() {
        return self::$siteTree;
    }

    public static function getSiteTreeColumn($columnName) {
        $urlList = array_column(self::$siteTree, $columnName);
        return $urlList;
    }
    
    public static function getSiteTreePage($index) {
        return self::$siteTree[$index];
    }

}
