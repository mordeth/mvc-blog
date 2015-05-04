<?php

//Handle the URL Request
$request_url = $_SERVER['REQUEST_URI'];

//Define Paths
define('ROOT_DIR', dirname(__FILE__) . '/');
$root = explode('/', substr($request_url, 1));
define('ROOT_URL', '/' . $root[0] . '/');

//Include config file
require_once('config/db.config.php');

//Include DB Class
require_once('includes/db.class.php');

//Init DB Class
$db = new DB_Class();

//Include UserAuth Class
require_once('includes/auth.class.php');

//Include Main Controller
include_once('controllers/MainController.php');

//Define default controller
$controller = 'Main';
$action = 'render';

// Extract data from the HTTP request
$requestPath = parse_url($request_url, PHP_URL_PATH);
$requestPath = substr( $requestPath, strlen( ROOT_URL ) );
$requestParts = explode('/', $requestPath);
if (count($requestParts) >= 1 && $requestParts[0] != '') {
    $controller = strtolower($requestParts[0]);
    if (! preg_match('/^[a-zA-Z0-9_]+$/', $controller)) {
        die('Invalid controller name. Use letters, digits and underscore only.');
    }
}
if (count($requestParts) >= 2 && $requestParts[1] != '') {
    $action = $requestParts[1];
    if (! preg_match('/^[a-zA-Z0-9_]+$/', $action)) {
        die('Invalid action name. Use letters, digits and underscore only.');
    }
}
$params = [];
if (count($requestParts) >= 3) {
    $params = array_splice($requestParts, 2);
}

if ( isset( $controller ) && file_exists( 'controllers/' . ucfirst($controller) . 'Controller.php' ) ) {
	//Handle if Admin Area
	$is_admin = '';
	$admin_folder = '';
	$admin_path = $is_admin ? 'admin/' : '';
	include_once 'controllers/' . $admin_folder . ucfirst($controller) . 'Controller.php';

	$controller_class =	ucfirst( $controller ) . '_Controller';

	$instance = new $controller_class();
	
	// Call the Action
	if( method_exists( $instance, $action ) ) {
		call_user_func_array( array( $instance, $action ), array( $params ) );
	} else {
		call_user_func_array( array( $instance, 'index' ), array() );
	}
} else {
	//Init Main controller
	$main = new Main_Controller();
	
	$main->render();
}


?>