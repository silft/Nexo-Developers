<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Nexo_wowemu {
	
	private $emulator;
	
	private $uc_emulator;
	
	private $extension_object;
	
	private $extension_class;
	
	public function wowemu()
	{		
		// Config of the WowEmu System
		$this->CI =& get_instance();
		$this->CI->auth = $this->CI->load->database('auth', TRUE);
		$this->emulator = strtolower($this->CI->config->item('emulator'));
		$this->uc_emulator = ucfirst(strtolower($this->emulator));
		DEFINE('EMULATORS_PATH', APPPATH.'emulators'.DS.$this->emulator.DS);
		
		// Call the required files
		if(file_exists(EMULATORS_PATH.$this->emulator.EXT))
		{
			require EMULATORS_PATH.$this->emulator.EXT;
		} else {
			show_error('NexoCMS can\'t load the '.$this->emulator.EXT.' file, without that file Nexo can\'t run.');
		}
		
		// Build the new objects
		$this->CI->{$this->emulator} = new $this->uc_emulator;
		// Get the called models
		$this->get_model('trinity_model');
		// Get the called extensions
		$this->get_extension('world');
		$this->get_extension('characters');
	}
	
	private function get_model($filename)
	{
		$model_object = strtolower($filename);
		$model_class = ucfirst(strtolower($filename));
		if(file_exists(EMULATORS_PATH.'Models'.DS.$filename.EXT))
		{
			require EMULATORS_PATH.'Models'.DS.$filename.EXT;
			return $this->CI->{$model_object} = new $model_class;
			
		} else {
			show_error('NexoCMS can\'t load the '.$filename.EXT.' file, without that file Nexo can\'t run.');
		}
	}
	private function get_extension($filename)
	{
		$this->extension_object = strtolower($filename);
		$this->extension_class = ucfirst(strtolower($filename));
		if(file_exists(EMULATORS_PATH.'Extensions'.DS.$filename.EXT))
		{
			require EMULATORS_PATH.'Extensions'.DS.$filename.EXT;
			return $this->CI->{$this->emulator}->{$this->extension_object} = new $this->extension_class;
			
		} else {
			show_error('NexoCMS can\'t load the '.$filename.EXT.' file, without that file Nexo can\'t run.');
		}
	}

}
?>