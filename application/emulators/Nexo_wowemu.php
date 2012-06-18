<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Nexo_wowemu {
	
	protected $emulator;
	
	private $required_file;
	
	private $objects;
	
	private $classes;
	
	public function wowemu()
	{		
		// Config of the WowEmu System
		$this->CI =& get_instance();
		$this->CI->auth = $this->CI->load->database('auth', TRUE);
		$this->emulator = strtolower($this->CI->config->item('emulator'));
		DEFINE('EMULATORS_PATH', APPPATH.'emulators'.DS.$this->emulator.DS);
		$this->required_file = array(
			'emulator' => $this->emulator,
			'world' => strtolower('world'),
			'characters' => strtolower('characters'),
		);
		$this->objects = array(
			'emulator' => $this->emulator,
			'model' => $this->emulator.'_model',
			'world' => strtolower($this->required_file['world']),
			'characters' => strtolower($this->required_file['characters'])
		);
		$this->classes = array(
			'emulator' => ucfirst($this->emulator),
			'model' => ucfirst($this->emulator).'_model',
			'world' => ucfirst(strtolower($this->objects['world'])),
			'characters' => ucfirst(strtolower($this->objects['characters']))
		);
		
		// Call the required files
		if(file_exists(EMULATORS_PATH.$this->required_file['emulator'].EXT))
		{
			require EMULATORS_PATH.$this->required_file['emulator'].EXT;
		} else {
			show_error('NexoCMS can\'t load the '.$this->required_file['emulator'].EXT.' file, without that file Nexo can\'t run.');
		}
		if(file_exists(EMULATORS_PATH.'Models'.DS.$this->required_file['emulator'].'_model'.EXT))
		{
			require EMULATORS_PATH.'Models'.DS.$this->required_file['emulator'].'_model'.EXT;
		} else {
			show_error('NexoCMS can\'t load the '.$this->required_file['emulator'].EXT.' file, without that file Nexo can\'t run.');
		}
		if(file_exists(EMULATORS_PATH.'World'.DS.$this->required_file['world'].EXT))
		{
			require EMULATORS_PATH.'World'.DS.$this->required_file['world'].EXT;
		} else {
			show_error('NexoCMS can\'t load the '.$this->required_file['world'].EXT.' file, without that file Nexo can\'t run.');
		}
		if(file_exists(EMULATORS_PATH.'Characters'.DS.$this->required_file['characters'].EXT))
		{
			require EMULATORS_PATH.'Characters'.DS.$this->required_file['characters'].EXT;
		} else {
			show_error('NexoCMS can\'t load the '.$this->required_file['characters'].EXT.' file, without that file Nexo can\'t run.');
		}
		
		// Build the new objects
		$this->CI->{$this->objects['emulator']} = new $this->classes['emulator'];
		$this->CI->{$this->objects['model']} = new $this->classes['model'];
		$this->CI->{$this->objects['emulator']}->{$this->objects['world']} = new $this->classes['world'];
		$this->CI->{$this->objects['emulator']}->{$this->objects['characters']} = new $this->classes['characters'];
	}

}
?>