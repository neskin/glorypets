<?php
class Glossary_search extends MX_Controller {
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
		$glossary_search = $this->$model->get_glossary_search();
		$this->tp->D['glossary_search'] = $glossary_search;
		$glossary_category = $this->$model->get_category();
		$this->tp->D['glossary_category'] = $glossary_category;
		
		$this->tp->parse($this->tag, $this->mname.'/'.$this->mname.'.php');
	}
}