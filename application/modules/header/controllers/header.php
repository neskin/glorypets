<?php
class Header extends MX_Controller {
	public $mname, $tag;
	
	function __construct() {
		$this->mname = strtolower(get_class());		// имя модуля
		$this->tag = strtoupper($this->mname); 		// «Тэг» в шаблоне
		$this->load->model($this->mname.'/'.$this->mname.'_model');		// загрузка модели
		
	}

	public function index() {
		$model = $this->mname.'_model';				// переменная модели
		$menu = $this->$model->index();
		$this->tp->D['menu'] = $menu;
		$this->tp->parse($this->tag, $this->mname.'/'.$this->mname.'.php');
	}
}