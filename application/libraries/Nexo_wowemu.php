<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Nexo_wowemu {
	
	protected $emulator;
	
	protected $AUTH_DB;
	
	protected $WORLD_DB;
	
	protected $CHAR_DB;
	
	public function __construct()
	{		
		$Nexo =& get_instance();
		
		$Nexo->load->model('Wowemu_model');
		
		DEFINE('DS', DIRECTORY_SEPARATOR);
		
		$this->emulator_dir = FCPATH.str_replace("/", "\\", APPPATH).'emulators'.DS;
		
		$this->g_route = FCPATH.str_replace("/", "\\", APPATH).'emulators'.DS;
	}
	
	public function get_realm($id)
	{
		$this->get_realm = $Nexo->Wowemu_model->get_realm($id);
		
		foreach($this->get_realm as $realm)
		{
			if(!is_numeric($realm['id']))
			{
				show_error('<h1>Error 01:</h1><br />The "realm.id" wanted is not a numeric value.');
			}
			
			$this->emulator = $realm['emulator'];	$this->AUTH_DB = $realm['auth_db'];
			$this->WORLD_DB = $realm['world_db'];	$this->CHAR_DB = $realm['char_db'];
			
			$Nexo->Nexo_wowemu->get_emulator_file('auth', $this->emulator);
			
			$Nexo->Nexo_wowemu->get_emulator_file('world', $this->emulator);
			
			$Nexo->Nexo_wowemu->get_emulator_file('characters', $this->emulator);
		}
	}
	
	private function get_emulator_file($type, $emulator)
	{
		switch($type)
		{
			case 'auth':
				if(file_exists($this->emulator_dir.$emulator.DS.'auth'.DS.'auth'.EXT))
				{
					require($this->emulator_dir.$emulator.DS.'auth'.DS.'auth'.EXT);
				}
				else {
					show_error('<h1>Error 06:</h1><br />Nexo can\'t load the "auth" file of the emulator.');
				}
			break;
			
			case 'world':
				if(file_exists($this->emulator_dir.$emulator.DS.'world'.DS.'world'.EXT))
				{
					require($this->emulator_dir.$emulator.DS.'world'.DS.'world'.EXT);
				}
				else {
					show_error('<h1>Error 07:</h1><br />Nexo can\'t load the "world" file of the emulator.');
				}
			break;
			
			case 'characters':
				if(file_exists($this->emulator_dir.$emulator.DS.'characters'.DS.'characters'.EXT))
				{
					require($this->emulator_dir.$emulator.DS.'characters'.DS.'characters'.EXT);
				}
				else {
					show_error('<h1>Error 08:</h1><br />Nexo can\'t load the "characters" file of the emulator.');
				}
			break;
			
			default:
				show_error('<h1>Error 09:</h1><br />Nexo can\'t load the a file of the emulator, becouse you have been set a bad data for the function.');
			break;
		}
	}
}
?>