<?php
	
class Nexo_plugins
{
	private $p_route;
	
	private $p_dir;
	
	public function __construct(){
		$this->p_dir = $Nexo->config->item('plugin_folder');
		
		$this->p_route = FCPATH . str_replace("/", "\\", APPPATH) . $this->p_dir . DS;
		
	}
	
		
	public function install_plugin($name, $file_name){
		
		if(is_numeric($name))
		{
			show_error("<h1>Error</h1>the name of a plugin can't be numeric");
		}
		
		$a_info = pathinfo($file_name);
		
			if($a_info['extension'] != 'php')
			{
				show_error("<h1>Error</h1>the extension of a plugin can't be different of PHP");
			}
			$r_file_name = explode('.', $a_info['basename']);
			
			$Nexo->Plugins_model->register_plugin($name, $r_file_name[count($r_file_name) - 1]);
	}
	
	public function active_plugin($name){
		if(is_numeric($name))
		{
			show_error("<h1>Error</h1>the name of a plugin can't be numeric");
		}
		
		
	}

	
	public function get_available_plugins($name){
		if(is_numeric($name))
		{
			show_error("<h1>Error</h1>the name of a plugin can't be numeric");
		}
	}
	
	public function validate_plugin($name){
		if(is_numeric($name))
		{
			show_error("<h1>Error</h1>the name of a plugin can't be numeric");
		}
	}
	
	public function create_plugin($name){
		if(is_numeric($name))
		{
			show_error("<h1>Error</h1>the name of a plugin can't be numeric");
		}
	}
	
	public function html_plugin($content){
		if(is_numeric($name))
		{
			show_error("<h1>Error</h1>the name of a plugin can't be numeric");
		}
		if(strlen(trim($content)) == 0)
		{
			show_error("<h1>Error</h1>the content of a html plugin can't be null");
		}
	}
}
?>