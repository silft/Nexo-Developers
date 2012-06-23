<?php 
if(!DEFINED('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
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
			$data['news'][$news]['author'] = ucfirst(strtolower($data['news'][$news]['author']));
			$data['news'][$news]['total_comments'] = intval($this->news_model->get_num_comments($data['news'][$news]['id']));
		}
		$this->nexo_template->parse_view('home', $data);
	}
	
	public function view($id)
	{
		$data['news'] = $this->news_model->get_news($id);
		if(empty($data['news']))
		{
			show_404();
		}
		$data['comments'] = $this->news_model->get_comments($id);
		foreach($data['news'] as $news => $return)
		{
			$data['news'][$news]['date'] = date("d/m/Y, g:ia", $return['date']);
			$data['news'][$news]['author'] = ucfirst(strtolower($data['news'][$news]['author']));
			$data['news'][$news]['total_comments'] = (int)$this->news_model->get_num_comments($id);
		}
		foreach($data['comments'] as $comments => $return)
		{
			$data['comments'][$comments]['content'] = $return['content'];
			$data['comments'][$comments]['author'] = ucfirst(strtolower($return['author']));
			$data['comments'][$comments]['date'] = date("d/m/Y, g:ia", $return['date']);
		}
		$this->nexo_template->parse_view('view', $data);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */