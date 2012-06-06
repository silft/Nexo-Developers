<?php 
if(!DEFINED('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	/*
	*
	*
	*
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('Pages_model');
		$this->load->library('parser');
	}
	/*
	*
	*
	*
	*/
	public function index()
	{	
		$info['test'] = "Under construction";
		$this->load->view('pages', $info);
	}
	/*
	*
	*
	*
	*/
	public function how_to_connect()
	{
		$info['test'] = $this->Pages_model->get_how_to_connect();
		foreach($info['test'] as $info)
			$info['test'] = $info['content'];
		$this->load->view('pages', $info);
	}
	/*
	*
	*
	*
	*
	*/
	public function custom($page)
	{
		$info['test'] = 'This is the custom page of: '.$page;
		$this->load->view('pages', $info);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */