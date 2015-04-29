<?php

//Include config file
require_once('config/db.config.php');

//Include DB Class
require_once('includes/db.class.php');

$db = new DB_Class();

define('ROOT_DIR', dirname(__FILE__));

$root = explode('/', substr($_SERVER['REQUEST_URI'], 1));
define('ROOT_URL', '/' . $root[0] . '/');

include_once 'controllers/MainController.php';

?>