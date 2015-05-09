<?php

class Posts_Model extends Base_Model {
	public function __construct( $args = array() ) {
		parent::__construct( array(
			'table' => 'posts'
		) );
	}
	
	public function process_tags( $tags, $post_id ) {
		$this->table = 'tags';

		$tags = explode(',', $tags);
		
		foreach($tags as $tag) {
			$post = $this->insert( 
				array( 
					'title' => $tag, 
					'post_id' => $post_id
				)
			);
		}

	}

}

?>