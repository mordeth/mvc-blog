<?php
class Authentication {
	
	private static $session = null;
	
	private function __construct() {
		// Session lifetime = 30min
		session_set_cookie_params(1800,"/");
		session_start();
	}
	
	public static function get_instance() {
		static $instance = null;
		
		if ( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public function is_logged() {
		if ( isset( $_SESSION['username'] ) ) {
			return true;
		}
		return false;
	}
	
	public function login( $username, $password ) {
		
	}
	
	public function get_user() {
		
	}
	
	public function logout( ) {
		
	} 
	
	
}
?>