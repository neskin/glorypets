<?php
class Footer extends MX_Controller {
	public $mname, $tag;
	
	function __construct() {
		$this->mname = strtolower(get_class());		// имя модуля
		$this->tag = strtoupper($this->mname); 		// «Тэг» в шаблоне
	}

	public function index() {
		//$this->load->model($this->mname.'/'.$this->mname.'_model');
		//$model = $this->mname.'_model';
		//$this->$model->index($this->mname);
		$this->tp->parse($this->tag, $this->mname.'/'.$this->mname.'.php');
	}
}