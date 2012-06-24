<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Pages_model extends CI_Model{

	protected $get_how_to_connect = array();
	
	public function __construct(){
		parent::__construct();
	}
	
	/*
	*	get_how_to_connect
	*	-------------------------------------
	*	We get the config how_to_connect
	*	from the database. Under developing
	*
	*/
	public function get_how_to_connect()
	{
		$this->get_how_to_connect = array('uri' => 'how_to_connect');
		$this->db->limit(1);
		$this->query = $this->db->get_where('custom_pages', $this->get_how_to_connect);
		return $this->query->result_array();
	}
	
}
?>