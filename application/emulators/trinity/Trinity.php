<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Trinity {
	
	private $username;
	
	private $email;
	
	public function __construct()
	{
		$this->NX =& get_instance();
	}
	
	public function create_account($username, $password, $email, $ip = "0.0.0.0")
	{
		$this->username = $username;
		$this->email = $email;
		if($this->username = $this->NX->trinity_model->in_use($username, 'username'))
		{
			return FALSE;
		}
		elseif($this->email = $this->NX->trinity_model->in_use($email, 'email'))
		{
			return FALSE;
		}
			return $this->NX->trinity_model->create_new_account($username, $password, $email, $ip);
	}
	
}
?>