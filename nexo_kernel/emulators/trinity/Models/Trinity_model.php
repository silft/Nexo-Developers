<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Trinity_model extends CI_Model {
	
	private $build_query;
	
	private $query;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function in_use($data, $type)
	{
		switch($type)
		{
			case 'username':
				$this->build_query = "SELECT `username` FROM `account` WHERE `username` = ?";
				$this->query = $this->auth->query($this->build_query, array($data));
				return $this->query->result();
			break;
			
			case 'email':
				$this->build_query = "SELECT `username` FROM `account` WHERE `email` = ?";
				$this->query = $this->auth->query($this->build_query, array($data));
				return $this->query->result();
			break;
			
			default:
				show_error('We have been founded a bad use of the "in_use($type)" function.');
			break;
		}
	}
	
	public function create_new_account($username, $password, $email, $ip)
	{
		$data = array(
			'username' => $username,
			'sha_pass_hash' => strtolower(sha1($username.':'.$password)),
			'email' => $email,
			'last_ip' => $ip
		);
	 $this->query = $this->auth->insert('account', $data); 
	 return $this->query;
	}
}
?>