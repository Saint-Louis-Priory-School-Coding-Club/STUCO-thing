<?php
if (!isset($_SESSION)) {
    session_start();
}
$inifile = parse_ini_file('setup.ini');
foreach ($inifile as $key => $ind) {
    define('__'.$key, $ind);
}
//autoloader
    function my_autoloader($class) {
        $filec = 'Controllers/' . $class . '.php';
        $filel = 'Library/' . $class . '.php';
        if (file_exists($filec)) {
            require_once $filec;
        } elseif (file_exists($filel)) {
            require_once $filel;
        }else {
            $pagenotfound = new View;
            $pagenotfound->e404();
            //die();
            // Uncomment VVVVVV For Debuging Pages
            die('The file: ' . $class . ' does not exist inside of the Controllers folder <br> The file: ' . $class . ' does not exist inside of the Library folder');
        }
    }
    spl_autoload_register('my_autoloader');
if (!isset($_GET['url'])) $url = ['index'];
elseif ($_GET['url'] == 'index.php') $url = ['index'];
else $url = explode ('/', rtrim($_GET['url'], '/'));
$length = sizeof($url);
$params = $url;
unset($params[1]);
unset($params[0]);
if (sizeof($params) == 0) {
    $params = NULL;
} else {
    foreach($params as $key => $ind) {
        unset($params[$key]);
        $params[$key - 2] = $ind;
    }
}
$controller = new $url[0] or die();
if (isset($url[1]) && $params !== NULL && method_exists($controller, $url[1])) {
    //var_dump($params);
    $controller->{$url[1]}($params);
}
elseif (isset($url[1]) && method_exists($controller, $url[1])) {
    $controller->{$url[1]}();
}
elseif (method_exists($controller, 'build') && !isset($url[1])) {
    $controller->build();
}
elseif (method_exists($controller, 'e404')) {
    $controller->e404();
}
else {
    $lastresort = new View;
    $lastresort->e404();
}