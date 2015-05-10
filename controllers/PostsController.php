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
		
		if(!empty($_POST)) {
			if(!empty($_POST['text'])) {
				
				if(empty($_POST['name']) && !isset($_SESSION['user_id'])) {
					$this->actionMessage = 'Name is required!';
				} else {
					if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
						$name = htmlentities($_POST['name']);
						$email = htmlentities($_POST['email']);
					} else {
						$user = $this->model->find(array( 'table' => 'users', 'where' => 'id = "' .$_SESSION['user_id'].'"' ));
						$name = $user[0]['username'];
						$email = $user[0]['email'];
					}
					
					$text = htmlentities($_POST['text']);
					
					$post = $this->model->insert( 
						array( 
							'name' => $name, 
							'text' => $text, 
							'email' => $email, 
							'postid' => $id[0]
						),
						'comments'
					);

					if(!empty($post)) {
						$this->actionMessage = 'Your comment was successfully published!';
					}
				}
				
			} else {
				$this->actionMessage = 'Comment text is required!';
			}
		}
		
		$views_count = $this->model->find(array( 'columns' => 'views', 'where' => 'id = "' .$id[0].'"' ));
		$views_count = $views_count[0]['views'] + 1;
		$views = array(
			'id' => $id[0],
			'views' => $views_count
		);

		$this->model->update( $views );
		
		$this->post = $this->model->list_post($id);
		
		$this->post_comments = $this->model->find(array( 'table' => 'comments', 'where' => 'postid = "' .$id[0].'"' ));
		
		$this->title = $this->post[0]['title'];
		
		$this->renderView();
	}
	
	public function search() {
		$this->layout = 'posts.php';
		$this->title = 'Search for: '.htmlentities($_POST['search']);
		$this->archive_title = htmlentities($_POST['search']);
		$this->archive_type = 'Tag';
		
		$this->posts = $this->model->list_posts_by_tag(htmlentities($_POST['search']), true);
		
		$this->renderView();
	}
	
	public function bydate($args) {
		$this->layout = 'posts.php';
		$this->title = 'List posts by: '.htmlentities($args[0]). ' '.date("F", mktime(0, 0, 0, $args[1], 10));
		$this->archive_title = htmlentities($args[0]). ' '.date("F", mktime(0, 0, 0, $args[1], 10));
		$this->archive_type = 'Date';

		$this->posts = $this->model->list_posts_by_date($args[0], $args[1]);
 
        $this->renderView();
    }
	
	public function bytag($id) {
		$this->layout = 'posts.php';
		$this->title = 'List posts tagged by: '.htmlentities($id[0]);
		$this->archive_title = htmlentities($id[0]);
		$this->archive_type = 'Tag';
		
		$this->posts = $this->model->list_posts_by_tag($id[0]);
		
		$this->renderView();
	}
	
	public function byauthor($id) {
		$this->layout = 'posts.php';
		$this->title = 'List posts published by: '.$this->model->get_username($id);
		$this->archive_title = $this->model->get_username($id);
		$this->archive_type = 'Author';
		
		$this->posts = $this->model->list_posts_by_author($id);
		
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