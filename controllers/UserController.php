<?php
class User_Controller extends Main_Controller {
	
	public function __construct() {
		parent::__construct( 'user', '/views/user/' );
		$this->title = 'User Login';
		$this->layout = 'login.php';
	}
	
	public function render() {
		header( 'Location: ' . ROOT_URL. 'user/login' );
	}
	
	public function login() {
		$user_auth = UserAuth::get_instance();
		$user = $user_auth->get_user();
		$this->actionMessage = '';
		
		if ( empty( $user ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
			
			$logged_in = $user_auth->login( htmlentities($_POST['username']), htmlentities($_POST['password'])) ;
			
			if ( ! $logged_in ) {
				$this->actionMessage = 'Login not successful.';
			} else {
				$this->logged_in_user = $user_auth->get_user();
				$this->actionMessage = 'Login was successful! Welcome ' . $_POST['username'];
			}
		}	

		$this->renderView();
	}
	
	public function register() {
		$this->title = 'User Registration';
		$this->layout = 'register.php';
		$this->actionMessage = '';
		
		if(!empty($_POST)) {
			if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])) {
				$name = htmlentities($_POST['name']);
				$username = htmlentities($_POST['username']);
				$password = htmlentities($_POST['password']);
				$repassword = htmlentities($_POST['repassword']);
				
				if($password == $repassword) {
					if(empty($this->model->user_exist($username))) {
						$rows = $this->model->insert( array( 'name' => $name, 'username' => $username, 'password' => md5($password)));
						header( 'Location: ' . ROOT_URL .'user/login' );
						exit();
					} else {
						$this->actionMessage = 'Username Exist!';
					}
					
				} else {
					$this->actionMessage = 'Password doesnt match!';
				}
			} else {
				$this->actionMessage = 'All fields are required!';
			}
		}
		
		$this->renderView();
	}
	
	public function logout() {
		$user = UserAuth::get_instance();
		
		$user->logout();
		
		header( 'Location: ' . ROOT_URL );
		exit();
	}
	
}
?>