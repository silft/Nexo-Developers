<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Nexo_template {
	
	//Var for the active template
	private $active_template; 
	//Var for the URL (http://example.com)
	private $m_url;
	//Var for the template directory
	private $template_dir;
	//Var for the site title
	private $site_title;
	//Var for the config site title (used on site_title() method)
	private $config_site_title;
	//Var for the route parameter (used on load_template_file() method)
	private $g_route;
	//Var for the BBCode String
	protected $bbcode_string;
	//Var for the template folder config
	protected $template_folder;
	/*
	*	Constructor
	*	--------------------------------------------
	*	We load everything for the functions.
	*
	*/
	public function __construct() {
		$Nexo =& get_instance();
		$Nexo->load->model('Template_model');
		//We need to know what is the active template
		$this->active_template = $Nexo->Template_model->get_active_template();
		//$this->active_template is an array like: Array(0=>(Array('id'=>'1', 'name' => 'default', 'installed'=>'1', 'active'=>'1')); so we get only the name value
		foreach($this->active_template as $template)
			$this->active_template = $template['name'];
		//Definition for a directory separator (Windows: \ | Linux: /)
		DEFINE('DS', DIRECTORY_SEPARATOR);
		//Template folder
		$this->template_folder = $Nexo->config->item('template_folder');
		//Template directory [just a route]
		$this->template_dir = FCPATH . str_replace("/", "\\", APPPATH) . $this->template_folder . DS . $this->active_template . DS;
		//Website URL
		$this->m_url = $Nexo->config->item('base_url');
		//Config Site Title
		$this->config_site_title = $Nexo->config->item('site_title');
		//Simple route
		$this->g_route = FCPATH . str_replace("/", "\\", APPPATH) . $this->template_folder. DS;
		
	}
	
	/*
	*	load_static_content
	*	--------------------------------------------
	*	With this function, the user can load static contents like:
	*		+images
	*		+css files
	*		+js files
	*	Or can add some static content by writing content using the 
	*	parameter $content. Also, remember to set the parameter
	*	$direct to false.
	*
	*	+Access: Public
	*	+Parameter: String($type) [Required]
	*	+Parameter: String($name) [Required]
	*	+Parameter: Boolean($direct)
	*	+Parameter: String($content)
	*	+Parameter: String($ext)
	*	+Returns: Void
	*
	*/
	public function load_static_content($type, $name, $direct = TRUE, $content = '', $ext = '.jpg') {
		/*
		* First, we check the type of the content, we save it on a new name and we add the name on the var.
		* Valid types: CSS, JS and IMAGES only.
		*/
		switch($type)
		{
			//If $type == 'css'
			case 'css':
				$full_name = 'css';
				/*
				*	Example:
				*		$name = 'style'
				*		$full_name = 'style.css'
				*/
				$full_name = $name . '.' . $full_name;
				if($direct)
				{
					$output = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->m_url . '/application/'.$this->template_folder.'/'.$this->active_template."/".$full_name."\" />\n";
					return $output;
				}
				else
				{
					$output = "<style type=\"text/css\">\n";
					$output .= $content."\n";
					$output .= "</style>\n";
					return $output;
				}
			break;
			//If $type == 'js'
			case 'js':
				$full_name = 'js';
				//Same functionality as CSS
				$full_name = $name . '.' . $full_name;
				if($direct)
				{
					$output = "<script type=\"text/javascript\" src=\"".$this->m_url . '/application/'.$this->template_folder.'/'.$this->active_template."/".$full_name."\"></script>\n";
					return $output;
				}
				else
				{
					$output = "<script type=\"text/javascript\">\n";
					$output .= $content."\n";
					$output .= "</script>\n";
					return $output;
				}
			break;
			//If $type == 'image'
			case 'image':
				//We use the $ext parameter for the image extension
				/*
				*	Example:
				*		$name = 'hello_world'
				*		$ext = '.jpg'
				*		$full_name = 'hello_world' . '.jpg' -> 'hello_world.jpg'
				*/
				$full_name = $name . $ext;
				$output = "<img src=\"".$this->m_url . '/application/'.$this->template_folder.'/'.$this->active_template."/".$full_name."\" alt=\"".$full_name."\" />\n";
				return $output;
			break;
			default:
				show_error('<h1>Error</h1><p>the function <b>load_static_content()</b> have an invalid parameter, check your <b>$type</b> parameter</p>');
			break;
		}

	}
	/*
	*	nexo_head
	*	--------------------------------------------
	*	This function load the header file from the
	*	active template. If the parameter $new_name
	*	is marqued as true, the function will try 
	*	to find the header file with the new name
	*	using the $name parameter.
	*
	*	+Access: Public
	*	+Parameter: Boolean($new_name)
	*	+Parameter: String($name)
	*	+Returns: Void
	*
	*/
	public function Nexo_head($new_name = FALSE, $name = '') {
		//If the name isn't "header.php", we can try to find it and include it!
		if($new_name)
		{
			//If the file with the new name exists, we load it
			if(file_exists($this->template_dir . $name . EXT))
			{
				require ($this->template_dir . $name . EXT);
			}
			//If the file doesn't exists, we show an error
			else
			{
				show_error('<h1>Error</h1><p>the file <b>'.$name . EXT .'</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
			}
		}
		else
		{
			//If the name is "header.php", we load it
			if(file_exists($this->template_dir . 'header.php'))
			{
				require ($this->template_dir . 'header.php');
			}
			//Or else, we show an error.
			else
			{
				show_error('<h1>Error</h1><p>the file <b>header.php</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
			}
		}
	}
	/*
	*	nexo_footer
	*	--------------------------------------------
	*	This function load the footer file from the
	*	active template. If the parameter $new_name
	*	is marqued as true, the function will try 
	*	to find the footer file with the new name
	*	using the $name parameter.
	*
	*	+Access: Public
	*	+Parameter: Boolean($new_name)
	*	+Parameter: String($name)
	*	+Returns: Void
	*
	*/
	public function Nexo_footer($new_name = FALSE, $name = '') {
		//If the name isn't "footer.php", we can try to find it and include it!
		if($new_name)
		{
			//If the file with the new name exists, we load it
			if(file_exists($this->template_dir . $name . EXT))
			{
				require ($this->template_dir . $name . EXT);
			}
			//If the file doesn't exists, we show an error
			else
			{
				show_error('<h1>Error</h1><p>the file <b>'.$name . EXT . '</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
			}
		}
		else
		{
			//If the name is "footer.php", we load it
			if(file_exists($this->template_dir . 'footer.php'))
			{
				require ($this->template_dir . 'footer.php');
			}
			else
			{
				show_error('<h1>Error</h1><p>the file <b>footer.php</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
			}
		}
	}
	/*
	*	site_title
	*	--------------------------------------------
	*	This function is under developing, we are 
	*	using a simple way to get the config and
	*	system site title, using the method parameter.
	*	The config method will never change the site 
	*	title, but the system method will change
	*	with the actual page
	*
	*	+Access: Public
	*	+Parameter: String($method)
	*	+Parameter: String($page)
	*	+Returns: String
	*
	*/
	public function site_title($method, $page = ''){
		//Site title
		switch($method)
		{
			//Using system method 
			//This method is using a secondary parameter meanwhile is under developing
			case 'sys':
				$this->site_title = $Nexo->Template_model->get_title() . ' - ' . $page;
			break;
			//Using config method
			case 'config':
				$this->site_title = $this->config_site_title;
			break;
			//if the method is wrong, we show an error
			default:
				show_error('<h1>Error</h1><p>the function <b>site_title()</b> have an invalid parameter, check your <b>$method</b> parameter</p>');
			break;
		}
		//Returns the site title
		return $this->site_title;
	}
	/*
	*	load_template_file
	*	--------------------------------------------
	*	This function load a custom file from the
	*	active template or try to load it from
	*	another directory if the $direct parameter
	*	is marqued as false. Also, remember, the
	*	$route parameter needs to be absolute.
	*
	*	+Access: Public
	*	+Parameter: String($name)
	*	+Parameter: Boolean($direct)
	*	+Parameter: String($template)
	*	+Returns: Void
	*
	*/
	public function load_template_file($name, $direct = TRUE, $template = '')
	{
		//If we load the template file directly from the "active_template" directory
		if($direct)
		{
			//If the file exists, we load it
			if(file_exists($this->template_dir . $name . EXT))
			{
				require($this->template_dir . $name . EXT);
			}
			//If don't, we show an error...
			else
			{
				show_error('<h1>Error</h1><p>the file <b>'.$name . EXT . '</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
			}
		}
		//If we need a template file from another route, we try to find it
		else
		{
			//If the file exists with the route, we load it...
			if(file_exists($this->g_route . $template . '/' . $name . EXT))
			{
				require($this->g_route . $template . '/' . $name . EXT);
			}
			//If don't, we show an error...
			else
			{
				show_error('<h1>Error</h1><p>the file <b>'.$name . EXT .'</b> on the custom load using load_template_file doesn\'t exists!</p>');
			}
		}
		
	}
	/*
	*	bbcode
	*	--------------------------------------------
	*	Using this function you will be able to
	*	use bbcode tags. The BBCode tags availables
	*	are:
	*		[b]X[/b] = Emulates <b>X</b>
	*		[i]X[/i] = Emulates <i>X</i>
	*		[u]X[/u] = Emulates <u>X</u>
	*		[s]X[/s] = Emulates <s>X</s>
	*		[url="*"]X[/url] = Emulates <a href="*">X</a>
	*		[url]*[/url] = Emulates <a href="*"></a>
	*		[align="*"]X[/align] = Emulates <div style="text-align: *">X</div>
	*		[img]*[/img] = Emulates <img src="*"></a>
	*		[font="*"]X[/font] = Emulates <span style="font-family: *">X</span>
	*		[size="*"]X[/size] = Emulates <span style="font-size: *">X</span>
	*		[color="*"]X[/color] = Emulates <span style="color: *">X</span>
	*		[code]X[/code] = Emulates <span class="code">X</span> | The CLASS can change
	*		[quote]X[/quote] = Emulates <span class="quote">X</span> | The CLASS can change
	*		[youtube]...[/youtube] = Emulates <span style="display: block;">...</span>
	*	... = The youtube bbcode will use the <object> tag, checking the ID parameter from
	*		  the youtube video. 
	*	X = Is a string, like "Hello world".
	*	* = Is a parameter
	*
	*	+Access: Public
	*	+Parameter: String($bbcode) [Required]
	*	+Returns: String
	*
	*	+Warning: This function is under developing, 
	*	some BBCode tags are not added yet
	*/
	public function bbcode($bbcode)
	{
		//Array for the bbcode tags....
		$bbcode_tags = array(
			'/\[b\](.*?)\[\/b\]/is', //[b][/b] Tag
			'/\[i\](.*?)\[\/i\]/is',//[i][/i] Tag
			'/\[u\](.*?)\[\/u\]/is',//[i][/i] Tag
			'/\[s\](.*?)\[\/s\]/is',//[i][/i] Tag
			'/\[url\=(.*?)\](.*?)\[\/url\]/is', //[url="*"]X[/url] Tag
			'/\[url\](.*?)\[\/url\]/is', //[url]X[/url] Tag
			'/\[align\=(left|center|right|justify)\](.*?)\[\/align\=(left|center|right|justify)\]/is', //[align="*"]X[/align]
			'/\[img\](.*?)\[\/img\]/is', //[img]*[/img]
			'/\[font\=(.*?)\](.*?)\[\/font\]/is', //[font="*"]X[/font]
			'/\[size\=(.*?)\](.*?)\[\/size\]/is', //[size="*"]X[/size]
			'/\[color\=(.*?)\](.*?)\[\/color\]/is', //[color="*"]X[/color]
			'/\[code\](.*?)\[\/code\]/is', //[code]X[/code]
			'/\[quote\](.*?)\[\/quote\]/is', //[quote]X[/quote]
			'/\[youtube](.*?)\[\/youtube\]/is', //[youtube]X[/youtube]
		);
		//Array for the html tags (we use HTML5 like a boss!)...
		$html_tags = array(
			'<b>$1</b>\n', //<b>X</b> Tag
			'<i>$1</i>\n', //<i>X</i> Tag
			'<u>$1</u>\n', //<u>X</u> Tag
			'<s>$1</s>\n', //<s>X</s> Tag
			'<a href="$1">$2</a>\n', //<a href="*">X</a> Tag
			'<a href="$1">$1</a>\n', //<a href="X">X</a> Tag
			'<div style="text-align:$1;">$2</div>\n', //<div style="text-align: *">X</div> Tag
			'<img src="$1" alt="$1"/>\n', //<img src="*" alt="*" /> Tag [Test it please]
			'<span style="font-family:$1;">$2</span>\n', //<span style="font-family: *">X</span> Tag
			'<span style="font-size:$1;">$2</span>\n', //<span style="font-size: *">X</span> Tag
			'<span style="color: $1;">$2</span>\n', //<span style="color: *">X</span> Tag
			'<span class="code">$1</span>\n', //<span class="code">X</span> Tag
			'<span class="quote">$1</span>\n', //<span class="quote">X</span> Tag
			'<span style="display:block;"><object width="350" height="275"><param name="movie" value="http://www.youtube.com/v/$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/$1" type="application/x-shockwave-flash" wmode="transparent" width="350" height="275"></embed></object></span>', //YouTube Tag [Using <object> tag] [Test it please]
		);
		//Let's clean the main string...
		$this->bbcode_string = htmlentities($bbcode);
		//Let's do the replace!
		$this->bbcode_string = preg_replace($bbcode_tags, $html_tags, $this->bbcode_string);
		//Let's add the <br />!...
		$this->bbcode_string = nl2br($this->bbcode_string);
		//And returns the value [I guess this must be changed to return $this, not sure...]
		return $this->bbcode_string;
		
	}
	/*
	*	check_template_xml
	*	--------------------------------------------
	*	Using this function, we check if the info.xml
	*	exists on the active template. 
	*
	*	+Access: Public
	*	+Parameter: String ($return_file_name)
	*	+Returns: Mixed [Depends on $exists parameter (Boolean/String)]
	*
	*/
	public function check_template_xml($return_file_name = false){
		if(!$return_file_name)
		{
			if(file_exists($this->template_dir . 'info.xml'))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(file_exists($this->template_dir . 'info.xml'))
			{
				return $this->template_dir . 'info.xml';
			}
			else
			{
				return false;
			}
		}
	}
	/*
	*	get_info_file
	*	--------------------------------------------
	*	We need to get the xml info from the info.xml
	*	file on the active template, we use this info
	*	for the admin system and in some other places
	*	If you will use this method, you need to do
	*	an array first, like: $array = array(); and
	*	then load the data one bye one.
	*	Example:
	*		$array = array();
	*		//NX is the object
	*		$array = $NX->get_info_file(); 
	*		echo $array['author'];
	*
	*	+Access: Public
	*	+Returns: Array
	*
	*	Warning: This function is under construction...
	*/
	public function get_info_file(){
		if($this->check_template_xml())
		{
			//We need a var for the info, we use an array
			$r_array = array();
			//We load the XML file...[We can't show any warning, so we use @, this is temporary]
			$mObjDOM = new DOMDocument();
			$mObjDOM->load($this->check_template_xml(true));
			$info_xml = $mObjDOM->getElementsByTagName("info");
			//We separate the info 
			foreach($info_xml as $info)
			{
				//Author info
				$author = $info->getElementsByTagName("author");
					$author = $author->item(0)->nodeValue;
						$r_array['author'] = $author;
				//Author URI info
				$authorURI = $info->getElementsByTagName("authorURI");
					$authorURI = $authorURI->item(0)->nodeValue;
						$r_array['authorURI'] = $authorURI;
				//Template name info
				$templateName = $info->getElementsByTagName("templateName");
					$templateName = $templateName->item(0)->nodeValue;
						$r_array['templateName'] = $templateName;
				//Description info
				$description = $info->getElementsByTagName("description");
					$description = $description->item(0)->nodeValue;
						$r_array['description'] = $description;
				//Version info
				$version = $info->getElementsByTagName("version");
					$version = $version->item(0)->nodeValue;
						$r_array['version'] = $version;
				//License info
				$license = $info->getElementsByTagName("license");
					$license = $license->item(0)->nodeValue;
						$r_array['license'] = $license;
				//Tags info
				$tags = $info->getElementsByTagName("tags");
					$tags = $tags->item(0)->nodeValue;
						$r_array['tags'] = explode(',', $tags);
				
			}
			//We returns all the data into an array
			return $r_array;
		}
		else
		{
			show_error('<h1>Error</h1><p>the active template doesn\'t have the info.xml file');
		}
	}
}
?>