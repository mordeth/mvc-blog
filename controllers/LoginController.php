<?php
class Login_Controller extends Main_Controller {
	
	public function __construct() {
		parent::__construct( 'main', '/views/user/' );
		$this->title = 'User Login';
		$this->layout = 'login.php';
	}
	
}
?>