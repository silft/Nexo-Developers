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
		$data = array();
		$this->trinity->create_account('Probando', 'pokmu123', 'pok_mu@hotmail.coms');
		if(isset($_POST['register']))
		{
			$data = array(
			'error_empty_username' => 'Please fill in the username field.',
			'error_empty_password' => 'Please fill in the password field.',
			'error_empty_email' => 'Please fill in the email field.',
			'error_empty_repeat_email' => 'Please fill in the email field again.',
			'error_empty_repeat_password' => 'Please fill in the password field again.',
			'error_password_do_not_match' => 'Passwords do not match.',
			'error_username_in_use' => 'The username is in use.',
			'error_email_in_use' => 'The email is in use.',
			'congrats_avaible_username' => 'The username is available.',
			'congrats_avaible_email' => 'The email is available.',
			'congrats_match_passwords' => 'The passwords match.',
			'congrats_match_email' => 'The email match.',
			'congrats_register_account' => 'The account \'{username}\' has been created successfully.',
			'congrats_register_account_restriction' => 'We have sent an email confirmation with a link to \'{email}\' with information of account activation.',
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'email' => $_POST['email'],
			'repeat_password' => $_POST['repeat_password'],
			'repeat_email' => $_POST['repeat_email']
			);
			if(empty($_POST['username']))
			{
				$data['error'] = "Please fill in the username field.";
			}
		}
		
		$this->parser->parse('register', $data);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/account.php */