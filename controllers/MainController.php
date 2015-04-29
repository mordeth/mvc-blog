<?php

class Main_Controller {
	
	protected $layout = 'home.php';
	
	protected $views =  '/views/layouts/';
	
	protected $model = null;
	
	protected $logged_in_user = array();
	
	public function __construct( $model = 'main', $views = '/views/layouts/' ) {
		$this->model = $model;
		$this->views = $views;
		
		$model_class = "\Models\\" . ucfirst( $model );  
		
		$this->model = new $model_class( array( 'table' => 'none' ) );
		
		$this->logged_user = Auth::get_instance()->get_logged_user();
	}
	
	public function home() {
		$template_file = ROOT_DIR . $this->views . 'home.php';
		
		include_once ROOT_DIR . '/views/layouts/' . $this->layout;
	}
}

?>