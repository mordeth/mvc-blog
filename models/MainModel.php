<?php

class Main_Model {
	
	protected $db;
	protected $table;
	protected $where;
	protected $columns;
	protected $limit;
	protected $dbconn;
	
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
}