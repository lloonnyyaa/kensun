<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT', dirname(__FILE__));

require 'vendor/autoload.php';

try {
    $params = $_REQUEST;

    if (!isset($params['controller'])) {
        throw new Exception('Controller not isset.');
    }
    
    $controller = ucfirst(strtolower($params['controller'])) . 'Controller';
    $action = strtolower($params['action']);
    
    if( file_exists(__DIR__."/controllers/{$controller}.php") ) {
        include_once __DIR__."/controllers/{$controller}.php";
    } else {
        throw new Exception('Controller is invalid');
    }
    
    $controller = new $controller();
    
    if( method_exists($controller, $action) === false ) {
        throw new Exception('Action is invalid.');
    }
    
    $result['data'] = $controller->$action();
    
} catch (Exception $e) {
    http_response_code(400);
    $result = [];
    $result['success'] = false;
    $result['errormsg'] = $e->getMessage();
}