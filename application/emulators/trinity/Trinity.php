<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Trinity {
	
	private $emulator;
	
	private $password;
	
	private $username;
	
	private $email;
	
	public function __construct()
	{
		$this->NX =& get_instance();
	}
	
	public function create_account($username, $password, $email)
	{
		$this->username = strtolower($username);
		$this->password = sha1($username.':'.$password);
		return TRUE;
	}
	public function check_email($email) {
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		return FALSE;
	}
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return FALSE;
		}
	}  
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return FALSE;
		}
	for ($i = 0; $i < sizeof($domain_array); $i++) {
		if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
			return FALSE;
			}
		}
	}
		return TRUE;
	}
}
?>