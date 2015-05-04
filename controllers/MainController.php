<?php

class Main_Controller {
	
	protected $layout = 'home.php';
	
	protected $views =  '/views/layouts/';
	
	protected $model = null;
	
	protected $logged_in_user = array();
	
	public function __construct( $model = 'main', $views = '/views/layouts/' ) {
		$this->model = $model;
		$this->views = $views;
		
		include_once ROOT_DIR . "models/{$model}Model.php";
		
		$model_class = ucfirst( $model ) . "_Model";  
		
		$this->model = new $model_class( array( 'table' => 'none' ) );
	}
	
	public function render() {
		$template_file = ROOT_DIR . $this->views . 'home.php';
		
		include_once ROOT_DIR . '/views/layouts/' . $this->layout;
	}
}

?>