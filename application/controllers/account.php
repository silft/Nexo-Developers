<?php 
if(!DEFINED('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Wowaccount_model');
		$this->load->library('parser');
	}

	public function index()
	{	
		$info['test'] = "Under construction";
		$this->load->view('pages', $info);
	}

	public function register()
	{
		if(isset($_POST['register']))
		{
		}
		$this->parser->parse('register', $data);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/account.php */