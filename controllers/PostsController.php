<?php
class Posts_Controller extends Main_Controller {
	
	public function __construct() {
		parent::__construct( 'posts', '/views/posts/' );
		$this->title = 'Login';
		$this->layout = 'login.php';
	}
	
	public function index() {
		header( 'Location: ' . ROOT_URL );
	}
	
	public function view($id) {
		$this->layout = 'post.php';
		
		$this->post = $this->model->list_post($id);
		
		$this->renderView();
	}
	
	public function add() {
		$this->title = 'Add new post';
		$this->layout = 'addpost.php';
		$this->actionMessage = '';
		
		if(!empty($_POST)) {
			if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['tags'])) {
				$title = htmlentities($_POST['title']);
				$content = htmlentities($_POST['content']);
				$tags = htmlentities($_POST['tags']);
				
				$post = $this->model->insert( 
					array( 
						'title' => $title, 
						'content' => $content, 
						'author' => $_SESSION['user_id'], 
						'views' => 0
					)
				);
				
				$tags = $this->model->process_tags($tags, $post);
				
				if(!empty($post)) {
					$this->actionMessage = 'Your post was successfully published!';
				}
				
			} else {
				$this->actionMessage = 'All fields are required!';
			}
		}
		
		$this->renderView();
	}
}
?>