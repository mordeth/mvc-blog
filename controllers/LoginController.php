<?php
class Login_Controller extends Main_Controller {
	
	public function __construct() {
		parent::__construct( 'main', '/views/user/' );
		$this->layout = 'login.php';
	}
	
	public function render() {
		$user_auth = UserAuth::get_instance();
		
		$user = $user_auth->get_user();

		include_once ROOT_DIR . '/views/user/' . $this->layout;
	}
}
?>