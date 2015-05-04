<?php

class DB_Class {
	
	private static $db;
	
	public function __construct() {
		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME );
		self::$db = $db;
		self::$db->set_charset("utf8");
	}
	
	public static function get_instance() {
		static $instance = null;
		
		if( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public static function get_db() {
		return self::$db;
	}
}