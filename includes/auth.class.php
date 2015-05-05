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
		$dbclass = DB_Class::get_instance();
		$db = $dbclass->get_db();
		
		
		$result = $db->prepare( "SELECT id FROM users WHERE username = ? AND password = MD5( ? ) LIMIT 1" );
		$result->bind_param( 'ss', $username, $password );
		
		$result->execute();
		
		$result_set = $result->get_result();
		
		if ( $row = $result_set->fetch_assoc() ) {
			$_SESSION['user'] = $username;
			$_SESSION['user_id'] = $row['id'];

			return true;
		}
		
		return false;
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