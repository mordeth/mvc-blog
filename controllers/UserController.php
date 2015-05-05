<?php
class User_Controller extends Main_Controller {
	
	public function __construct() {
		parent::__construct( 'main', '/views/user/' );
		$this->title = 'User Login';
		$this->layout = 'login.php';
	}
	
	public function render() {
		header( 'Location: ' . ROOT_URL. 'user/login' );
	}
	
	public function login() {
		$user_auth = UserAuth::get_instance();
		$user = $user_auth->get_user();
		$login_text = '';
		
		if ( empty( $user ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
			
			$logged_in = $user_auth->login( $_POST['username'], $_POST['password'] );
			
			if ( ! $logged_in ) {
				$login_text = 'Login not successful.';
			} else {
				$this->logged_in_user = $user_auth->get_user();
				$login_text = 'Login was successful! Hi ' . $_POST['username'];
			}
		}	

		//Include header layout
		include_once('views/layouts/header.php');
		
		//Include page layout
		include_once ROOT_DIR . $this->views . $this->layout;
		
		//Include sidebar
		include_once('views/layouts/sidebar.php');
		
		//Include footer layout
		include_once('views/layouts/footer.php');
	}
	
	public function logout() {
		$user = UserAuth::get_instance();
		
		$user->logout();
		
		header( 'Location: ' . ROOT_URL );
		exit();
	}
	
}
?>