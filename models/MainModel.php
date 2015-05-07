<?php

class Main_Model {
	
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
		
		return $this->db->affected_rows;
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
	
	
}