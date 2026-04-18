<?php

$controller = $_GET['controller'] ?? 'Auth';
$action = $_GET['action'] ?? 'login';

$controllerName = $controller . "Controller";
$controllerFile = "../app/controllers/" . $controllerName . ".php";

if (!file_exists($controllerFile)) {
    die("Controller not found.");
}

require_once $controllerFile;

$controllerObj = new $controllerName();

if (!method_exists($controllerObj, $action)) {
    die("Action not found.");
}

$controllerObj->$action();
?>