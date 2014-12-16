<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

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
    'deleteProject' => array(
        'controller' => 'Projects',
        'action' => 'deleteProject'
    ),
    'addNote' => array(
        'controller' => 'Projects',
        'action' => 'addNote'
    ),
    'addTodo' => array(
        'controller' => 'Projects',
        'action' => 'addTodo'
    ),
    'UpdateFunctie' => array(
        'controller' => 'Projects',
        'action' => 'UpdateFunctie'
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