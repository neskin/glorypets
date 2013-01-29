<?php
class Glossary extends MX_Controller {
	private $mname;
	public $tpl;

	function __construct() {
		$this->tpl = 'site.php'; 					// шаблон страницы
		$this->mname = strtolower(get_class());		// имя модуля
		$this->load->model($this->mname.'/'.$this->mname.'_model');		// загрузка модели
		$this->lang->load('glossary', 'russian');
	}

	public function index() {
		// Если функция не пуста - передаю управление в неё
		$func = $this->uri->segment(3);
		if($func != '' && method_exists($this->mname, $func) == true) {
			$this->$func($this->uri->segment(4)); 
			return false;
		}
		
		$model = $this->mname.'_model';				// переменная модели
		
		
		$glossary = $this->$model->get_glossary();
		$this->tp->D['glossary'] = $glossary;
		
		$this->tp->parse('CONTENT', $this->mname.'/'.$this->mname.'.php');
	}
	
	public function single($id) {
		$model = $this->mname.'_model';				// переменная модели
		$single = $this->$model->get_single($id);
		$this->tp->D['single'] = $single;
		//print_r($this->tp->D); die();
		$this->tp->parse('CONTENT', $this->mname.'/single.php');
	}
}