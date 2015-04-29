<?php

//Include config file
require_once('config/db.config.php');

//Include DB Class
require_once('includes/db.class.php');

$this->db = new DB_Class();
$all = $this->db->query("SELECT * FROM posts");
print_r($all);
?>