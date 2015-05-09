<?php

class Base_Model {
	
	protected $db;
	protected $table;
	protected $where;
	protected $columns;
	protected $limit;
	
	public function __construct( $args = array() ) {
		$args = array_merge( array(
			'where' => '',
			'columns' => '*',
			'limit' => 0
		), $args );
		
		if ( ! isset( $args['table'] ) ) {
			die( 'Table not defined. Please define a model table.' );
		}
		
		if(empty($table)) {
			$table = 'posts';
		}
		
		extract( $args );
		
		$this->table = $table;
		$this->where = $where;
		$this->columns = $columns;
		$this->limit = $limit;
		
		$instance = DB_class::get_instance();
		$this->db = $instance::get_db();
	}
	
	public function insert( $fields ) {
		$keys = array_keys( $fields );
		$values = array();
		foreach( $fields as $key => $value ) {
			$values[] = "'" . $this->db->real_escape_string( $value ) . "'";	
		}
		
		$keys = implode( $keys, ',' );
		$values = implode( $values, ',' );
		
		$query = "insert into {$this->table}($keys) values($values)";
		$this->db->query( $query );
		
		return $this->db->insert_id;
	}
	
	public function update( $model ) {
		$query = "UPDATE " . $this->table . " SET ";
		
		foreach( $model as $key => $value ) {
			if( $key === 'id' ) continue;
			$query .= "$key = '" . $this->db->real_escape_string( $value ) . "',"; 
		}
		$query = rtrim( $query, "," );
		$query .= " WHERE id = " . $model['id'];
		$this->db->query( $query );
		
		return $this->db->affected_rows;
	}
	
	public function find( $args = array() ) {
		$args = array_merge( array(
			'table' => $this->table,
			'where' => '',
			'columns' => '*',
			'limit' => 0
		), $args );
		
		extract( $args );
		
		$query = "select {$columns} from {$table}";
		
		if( ! empty( $where ) ) {
			$query .= ' where ' . $where;
		}
		
		if( ! empty( $limit ) ) {
			$query .= ' limit ' . $limit;
		}
		
		$query .= ' order by `id` DESC';

		$results = $this->db->query( $query );

		$result = $this->handle_result( $results );
		
		return $result;
	}
	
	protected function handle_result( $result ) {
		$results = array();
		
		if( ! empty( $result ) && $result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$results[] = $row;
			}
		}
		
		return $results;
	}
	
	public function user_exist( $username ) {
		$results = $this->find( array( 'where' => 'username = "' .$username.'"' ) );
		
		return $results;
	}
	
	public function list_posts() {
		$posts = array();
		$post_result = $this->find();
		
		$i=0;
		foreach($post_result as $post) {
			$posts[$i] = $post;
			
			$author = $this->find( array( 'table' => 'users', 'where' => 'id = "' .$post['author'].'"' ) );
			
			$posts[$i]['author_user'] = $author[0]['username'];

			$tags = $this->find( array( 'table' => 'tags', 'where' => 'post_id = "' .$post['id'].'"' ) );
			
			$posts[$i]['tags'] = $tags;
			
			$i++;
		}
		
		return $posts;
	}
	
	public function list_post($id) {
		
		$id = $id[0];
		
		$post = $this->find(array( 'where' => 'id = "' .$id.'"' ));
		
		$author = $this->find( array( 'table' => 'users', 'where' => 'id = "' .$post[0]['author'].'"' ) );

		$post[0]['author_user'] = $author[0]['username'];

		$tags = $this->find( array( 'table' => 'tags', 'where' => 'post_id = "' .$id.'"' ) );
		
		$post[0]['tags'] = $tags;

		return $post;

	}
	
	
}