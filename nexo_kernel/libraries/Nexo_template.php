<?php
if(!DEFINED('BASEPATH')) exit('Not allowed.');

class Nexo_template {
	
	//Var for the active template
	private $active_template; 
	//Var for the template wrapper
	private $template_wrapper;
	//Var for the URL (http://example.com)
	private $m_url;
	//Var for the template directory
	public $template_dir;
	//Var for the site title
	private $site_title;
	//Var for the config site title (used on site_title() method)
	private $config_site_title;
	//Var for the route parameter (used on load_template_file() method)
	private $g_route;
	//Var for the global variables for the template
	private $global_items;
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
		$this->NX =& get_instance();
		$this->NX->load->model('Template_model');
		//We need to know what is the active template
		$this->active_template = $this->NX->Template_model->get_active_template();
		//$this->active_template is an array like: Array(0=>(Array('id'=>'1', 'name' => 'default', 'installed'=>'1', 'active'=>'1')); so we get only the name value
		foreach($this->active_template as $template)
			$this->active_template = $template['name'];
			$this->template_wrapper = $template['wrapper'];
		//Template folder
		$this->template_folder = $this->NX->config->item('template_folder');
		//Template directory [just a route]
		$this->template_dir = FCPATH . str_replace("/", "\\", APPPATH) . $this->template_folder . DS . $this->active_template . DS;
		$this->NX->load->_ci_view_paths = array($this->template_dir => TRUE);
		//Website URL
		$this->m_url = $this->NX->config->item('base_url');
		//Config Site Title
		$this->config_site_title = $this->NX->config->item('site_title');
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
	public function load_static_content($type, $name, $direct = TRUE, $ext = 'jpg', $content = NULL) {
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
				$full_name = $name.'.'.$full_name;
				if($direct)
				{
					$output ="<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->m_url.APPPATH.$this->template_folder.'/'.$this->active_template.'/'.$full_name."\" />\n";
					echo $output;
				}
				else
				{
					$output = "<style type=\"text/css\">\n";
					$output .= $content."\n";
					$output .= "</style>\n";
					echo $output;
				}
			break;
			//If $type == 'js'
			case 'js':
				$full_name = 'js';
				//Same functionality as CSS
				$full_name = $name.'.'.$full_name;
				if($direct)
				{
					$output = "<script type=\"text/javascript\" src=\"".$this->m_url.APPPATH.$this->template_folder.'/'.$this->active_template.'/'.$full_name."\"></script>\n";
					echo $output;
				}
				else
				{
					$output = "<script type=\"text/javascript\">\n";
					$output .= $content."\n";
					$output .= "</script>\n";
					echo $output;
				}
			break;
			//If $type == 'image'
			case 'image':
				//We use the $ext parameter for the image extension
				/*
				*	Example:
				*		$name = 'hello_world'
				*		$ext = 'jpg'
				*		$full_name = 'hello_world' . '.jpg' -> 'hello_world.jpg'
				*/
				$full_name = $name.'.'.$ext;
				$output = "<img src=\"".$this->m_url.APPPATH.$this->template_folder.'/'.$this->active_template.'/'.$full_name."\" alt=\"".$full_name."\" />\n";
				echo $output;
			break;
			default:
				show_error('<p>The function <b>load_static_content()</b> have an invalid parameter, check your <b>$type</b> parameter</p>');
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
			if(file_exists($this->template_dir.$name.EXT))
			{
				require ($this->template_dir.$name.EXT);
			}
			//If the file doesn't exists, we show an error
			else
			{
				show_error('<p>The file <b>'.$name.EXT.'</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
			}
		}
		else
		{
			//If the name is "header.php", we load it
			if(file_exists($this->template_dir.'header.php'))
			{
				require ($this->template_dir.'header.php');
			}
			//Or else, we show an error.
			else
			{
				show_error('<p>The file <b>header.php</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
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
				show_error('<p>The file <b>'.$name . EXT . '</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
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
				show_error('<p>The file <b>footer.php</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
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
				$this->site_title = $this->NX->Template_model->get_title() . ' - ' . $page;
			break;
			//Using config method
			case 'config':
				$this->site_title = $this->config_site_title;
			break;
			//if the method is wrong, we show an error
			default:
				show_error('<p>The function <b>site_title()</b> have an invalid parameter, check your <b>$method</b> parameter</p>');
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
				show_error('<p>The file <b>'.$name . EXT . '</b> of the template <b>'.$this->active_template.'</b> doesn\'t exists!</p>');
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
				show_error('<p>The file <b>'.$name . EXT .'</b> on the custom load using load_template_file doesn\'t exists!</p>');
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
			//We load the XML file...
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
			show_error('<p>The active template doesn\'t have the info.xml file');
		}
	}
	/*
	*	add_widget_box
	*	--------------------------------------------
	*	If we use this function, we can create a custom
	*	widget box. This is only for "premade" widgets
	*
	*	+Access: Public
	*	+Parameter: Array ($i_attr) [Required]
	*	+Parameter: Array ($s_attr) [Required]
	*	+Patameter: Array ($t_attr) [Required]
	*	+Parameter: String ($title) [Required]
	*	+Parameter: String ($content) [Required]
	*	+Returns: String
	*
	*	Plus: The return string looks like this,
	*	with some example attributes.
	*		<div id="something" class="something-else">
	*			<div class="widget-title">
	*				Hello world!
	*			</div>
	*			<div class="widget-content">
	*				Hello world, this is a widget
	*			</div>
	*		</div>
	*/
	public function add_widget_box($i_attr, $s_attr, $t_attr, $title, $content){
		//Var for the attributes string
		$a = "";
		//Var for the secondary attributes string
		$s_a = "";
		//Var for the third attribute string
		$t_a = "";
		//Var for the return string
		$r_string = "";
		//We need to check if the $attr parameter is an array...
		if(is_array($i_attr))
		{
			foreach($i_attr as $attribute => $value)
			{
				$a .= ' ' . strtolower($attribute) . '="' . strtolower($value) . '"';
			}
			if(is_array($s_attr))
			{
				foreach($s_attr as $s_attribute => $s_value)
				{
					$s_a .= ' ' . strtolower($s_attribute) . '="' . strtolower($s_value) . '"';
				}
				if(is_array($t_attr))
				{
					foreach($t_attr as $t_attribute => $t_value)
					{
						$t_a .= ' ' . strtolower($t_attribute) . '="' . strtolower($t_value) . '"';
					}
					//we create a full string
					$r_string .= "<div ".$a.">\n";
					$r_string .= "	<div ".$s_a.">\n";
					$r_string .= "		".$title."\n";
					$r_string .= "	</div>\n";
					$r_string .= "	<div ".$t_a.">\n";
					$r_string .= "		".$content."\n";
					$r_string .= "	</div>\n";
					$r_string .= "</div>\n";
					//And we return our complete string
						return $r_string;
				}
				else
				{
					shhow_error('<p>The parameter $t_attr is not a valid var type</p>');
				}
			}
			else
			{
				show_error('<p>The parameter $s_attr is not a valid var type</p>');
			}
			
		}
		else
		{
			show_error('<p>The parameter $i_attr is not a valid var type</p>');
		}
	}
	/*
	*	body
	*	--------------------------------------------
	*	We can add the body tag using this function
	*	and add some parameters on it.
	*
	*	+Access: Public
	*	+Parameter: Boolean ($i)
	*	+Parameter: Array ($attr)
	*	+Returns: String
	*
	*/
	public function body($i = true, $attr = array())
	{
		//We need a string for the attributes on the body tag
		$b_a = "";
		if($i)
		{
			//if we have some attributes, we add them on the body tag
			if(is_array($attr))
			{
				foreach($attr as $attribute => $value)
				{
					$b_a .= ' ' . strtolower($attribute) . '="' . strtolower($value) . '"';
				}
				return "<body ". $b_a . ">\n";
			}
			//or we can only return the <body> tag
			else
			{
				return "<body>\n";
			}
		}
		else
		{
			return "</body>\n";
		}
	}
	/*
	*	br
	*	--------------------------------------------
	*	Using this function, we can emulate the
	*	<br /> tag from HTML and add it all the times
	*	as we need it using the parameter.
	*
	*	+Access: Public
	*	+Parameter: Int ($jumps)
	*	+Returns: String
	*/
	public function br($jumps = 1)
	{
		//We need a var for the jump times we need it
		$br = "";
		//if our parameter is not numeric, we return an error
		if(!is_numeric($jumps))
		{
			show_error('<p>The $jumps parameter must be numeric</p>');
		}
		//Or if our parameter is less than 0
		elseif((int)$jumps <= 0)
		{
			show_error('<p>The $jumps parameter must be more than 0</p>');
		}
		//if we have a clean and useful parameter, we use it...
		else
		{
			for($i = 0; $i < $jumps; $i++)
			{
				$br .= "<br />\n";
			}
			return $br;
		}
	}
	/*
	*	h
	*	--------------------------------------------
	*	Using this function, we can emulate the
	*	<h>'s tags, such as <h1> to <h6> and
	*	add them some parameters.
	*
	*	+Access: Public
	*	+Parameter: Int ($num) [Required]
	*	+Parameter: Array($attr)
	*	+Parameter: String ($content) [Required]
	*	+Returns: String
	*
	*/
	public function h($num, $attr = array(), $content)
	{
		//Var for the $attr info
		$a_i = "";
		//If our var $num is not numeric, we show an error
		if(!is_numeric($num))
		{
			show_error('<p>The $num parameter must be numeric</p>');
		}
		//If our var $num is more than 6 or less than 1, we show an error
		elseif($num > 6 || $num < 1)
		{
			show_error('<p>The $num parameter must be 1, 2, 3, 4, 5 or 6 only</p>');
		}
		else
		{
			//we get the $attr info
			if(is_array($attr))
			{
				foreach($attr as $attribute => $value)
				{
					$a_i .= ' ' . strtolower($attribute) . '="' . strtolower($value) . '"';
				}
				return '<h'.$num.' '.$a_i.'>'.$content.'</h'.$num.">\n";
			}
			//If our $attr parameter is not an array, we show an error
			else
			{
				show_error('<p>The parameter $attr is not a valid var type</p>');
			}
		}
	}
	
	public function parse_view($view, $data = NULL)
	{
		//Load the Parser library
		$this->NX->load->library('parser');
		
		//Check if the view file exist, if doesn't exists display an error
		if(!file_exists($this->template_dir.'pages'.DS.$view.EXT))
		{
			show_error('Can\'t load the '.$view.EXT.' page.');
			break;
		}
		
		$this->global_items = array(
			'title'     => $this->NX->config->item('site_title'),
			'content'   => $this->NX->parser->parse('pages'.DS.$view, $data, TRUE),
			'copyright' => $this->NX->config->item('copyright')
		);
		
		//Check if the master template file exist, if doesn't exists display an error
		if(!file_exists($this->template_dir.$this->template_wrapper.EXT))
		{
			show_error('Can\'t load the '.$this->template_wrapper.EXT.' page.');
			break;
		}
				
		$output = $this->NX->parser->parse($this->template_wrapper, $this->global_items, TRUE);
		$this->NX->output->set_output($output);
		
		return $output;
		
	}
}
?>