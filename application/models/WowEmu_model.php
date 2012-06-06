<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Wowemu_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_realms()
	{
		$this->query = $this->db->get('realms');
		return $this->query->result_array();
	}
	
	public function get_realm($id)
	{
		$this->check_id = array('id' => $id);
		$this->db->limit(1);
		$this->query = $this->db->get_where('template',$this->check_id);
		return $this->query->result_array();
	}

}
?>