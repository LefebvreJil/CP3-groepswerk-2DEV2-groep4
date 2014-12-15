<?php
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

$routes = array(
    'home' => array(
        'controller' => 'Users',
        'action' => 'index'
    ),
    'register' => array(
        'controller' => 'Users',
        'action' => 'register'
    ),
    'logout' => array(
        'controller' => 'Users',
        'action' => 'logout'
    ),
    'projects' => array(
        'controller' => 'Projects',
        'action' => 'index'
    ),
    'addProject' => array(
        'controller' => 'Projects',
        'action' => 'addProject'
    ),
    'addNote' => array(
        'controller' => 'Projects',
        'action' => 'addNote'
    ),
    'addTodo' => array(
        'controller' => 'Projects',
        'action' => 'addTodo'
    ),
    'whiteboard' => array(
        'controller' => 'Projects',
        'action' => 'whiteboard'
    )
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
}
if(empty($_SESSION['user'])&& $_GET['page']!=='register') {
    $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
    header('Location: index.php');
    exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();