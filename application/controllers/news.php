<?php 
if(!DEFINED('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('parser');
		$this->load->model('news_model');
		$this->limit_news = $this->config->item('limit_news');
		$this->limit_comments = $this->config->item('limit_comments');
	}

	public function index()
	{
		$data['news'] = $this->news_model->get_all_news($this->limit_news);
		foreach($data['news'] as $news => $return)
		{
			$data['news'][$news]['date'] = date("d/m/Y, g:ia", $return['date']);
		}
		$this->parser->parse('home', $data);
	}
	
	public function view($id)
	{
		$data['news'] = $this->news_model->get_news($id);
		if(empty($data['news']))
		{
			show_404();
		}
		foreach($data['news'] as $news => $return)
		{
			$data['news'][$news]['date'] = date("d/m/Y, g:ia", $return['date']);
		}
		$this->parser->parse('view', $data);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */