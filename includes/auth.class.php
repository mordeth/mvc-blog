<?php
class UserAuth {

	private function __construct() {
		session_set_cookie_params(1800, "/");
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
		if ( isset( $_SESSION['user'] ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function login( $username, $password ) {
		
	}
	
	public function get_user() {
		if ( isset( $_SESSION['user'] )  ) {
			return array( 
					'user' => $_SESSION['user'], 
					'user_id' => $_SESSION['user_id'] 
			);
		} else {
			return array();
		}
	}
	
	public function logout() {
		session_destroy();
	} 
	
	
}
?>