<?php

class Main_Model extends Base_Model {
	public function __construct( $args = array() ) {
		parent::__construct( array(
			'table' => 'posts'
		) );
	}
}
?>