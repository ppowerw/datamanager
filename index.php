<?php
set_time_limit(120);

// Define autoloader
spl_autoload_register(function ($class_path) {
    require_once (str_replace('\\', '/', $class_path) . '.php');
});

$App = new \Core\Application;
$App->initApp();




