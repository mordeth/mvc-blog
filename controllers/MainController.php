<?php

class Main_Controller {
	
	protected $layout = 'posts.php';
	
	protected $views =  '/views/layouts/';
	
	protected $model = null;
		
	protected $logged_in_user = array();
	
	public function __construct( $model = 'main', $views = '/views/posts/' ) {
		$this->model = $model;
		$this->views = $views;
		$this->title = 'Home page';
		
		include_once ROOT_DIR . "models/{$model}Model.php";
		
		$model_class = ucfirst( $model ) . "_Model";  
		
		$user_auth = UserAuth::get_instance();
		
		$this->logged_in_user = $user_auth->get_user();
		
		$this->model = new $model_class( array( 'table' => 'none' ) );
	}
	
	public function render() {
		$this->posts = $this->model->list_posts();
		
		$this->renderView();
	}
	
	public function renderView() {
		//Include header layout
		include_once('views/layouts/header.php');
		
		//Include sidebar
		include_once('views/layouts/sidebar.php');
		
		//Include page layout
		include_once ROOT_DIR . $this->views . $this->layout;
		
		//Include footer layout
		include_once('views/layouts/footer.php');
	}
}

?>