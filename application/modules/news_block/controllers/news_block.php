<?php
class News_block extends MX_Controller {
	public $mname, $tag;
	
	function __construct() {
		$this->mname = strtolower(get_class());					// имя модуля
		$this->model_name = explode("_", $this->mname);
		$this->model_name = $this->model_name[0];				// имя модели
		$this->tag = strtoupper($this->mname); 					// «Тэг» в шаблоне
		
		$this->load->model($this->model_name.'/'.$this->model_name.'_model');		// загрузка модели
		
	}

	public function index() {
		$model = $this->model_name.'_model';				// переменная модели
		$news_block = $this->$model->get_block_news();
		$this->tp->D['news_block'] = $news_block;
		//$this->tp->assign('page_last_news', $this->lang->line('page_last_news'));
		//$this->tp->assign('page_top_news', $this->lang->line('page_top_news'));
		$this->tp->parse($this->tag, $this->mname.'/'.$this->mname.'.php');
	}
}