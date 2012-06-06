<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Template_model extends CI_Model{

	private $check_template = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_active_template()
	{
		$this->check_template = array('installed' => '1', 'active' => '1');
		$this->db->limit(1);
		$this->query = $this->db->get_where('template',$this->check_template);
		return $this->query->result_array();
	}
	
	public function get_title()
	{
		return 'NexoCMS Website';
	}

}
?>