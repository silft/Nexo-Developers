<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class News_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	
	public function get_all_news($limit)
	{
		$this->db->order_by('id desc');
		$this->query = $this->db->get('news', $limit);
		return $this->query->result_array();
	}
	
	public function get_news($id)
	{
		$this->db->limit(1);
		$this->query = $this->db->get_where('news', array('id' => $id));
		return $this->query->result_array();
	}
}
?>