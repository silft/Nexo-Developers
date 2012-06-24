<?php 
if(!DEFINED('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	protected $captcha;
	
	protected $captcha_image;
	
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
		$data = array(
			'username' => isset($_POST['username']),
			'password' => isset($_POST['password']),
			'email'    => isset($_POST['email']),
			'captcha'  => $this->captcha()
		);
		if(isset($_POST['register']))
		{
			if(empty($_POST['username']))
			{
				break;
			}
		}
		$this->nexo_template->parse_view('register', $data);
	}
	
	private function captcha()
	{
		$this->load->library('session');	
		$this->captcha = strtoupper(md5(microtime()));
		$this->captcha = substr($this->captcha, 0, 6);
		$this->session->set_flashdata('captcha_code', $this->captcha);
		return $this->captcha;
	}
}

/* End of file news.php */
/* Location: ./application/controllers/account.php */