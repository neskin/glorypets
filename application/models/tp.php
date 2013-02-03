<?php

class Tp extends CI_Model {
	
	// Объявляю переменные шаблона ---------------------------
	//
	public $D = array();
	public $tpl = '';
	
	// Загружаю класс парсера ---------------------------
	//
	function __construct() {
		$this->load->library('parser');
	}
	
	//  ---------------------------
	//
	function parse($label, $tpl) {
		$TPL = $this->load->view($tpl, FALSE, TRUE);
		$pattern = '/{[A-Za-z0-9_]+}/'; 				// метки могут быть лишь такими
		preg_match_all($pattern, $TPL, $MODULES); 		// находит метки в шаблоне
                
		foreach ($MODULES[0] as $MODULE) {
			$module = substr($MODULE,1,-1);
			$this->common->load_module(strtolower($module));	// ВАЖНО! Чтобы грузились метки в шаблонах!
			if (!isset($this->D[$module])) {				
				$this->D[$module] = $this->lang->line($module); // если они не определены, то смотрит в langs
			}
		}
		
		if (isset($this->D[$label])) {
			$this->D[$label] .= $this->parser->parse($tpl, $this->D, TRUE);
		} else {
			$this->D[$label] = $this->parser->parse($tpl, $this->D, TRUE);
		}
                
	}

	// 
	function load_tpl($tpl_name) {
		$TPL = $this->load->view('templates/'.$tpl_name, FALSE, TRUE);
		$pattern = '/{[A-Z0-9_]+}/';
		$pattern2 = '/{[a-z_]+}/';
		preg_match_all($pattern, $TPL, $MODULES); 		// находит модули
		preg_match_all($pattern2, $TPL, $VALUES); 		// находит переменные
                
		foreach ($MODULES[0] as $MODULE) {
			$module = substr($MODULE,1,-1);
			if (!isset($this->D[$module])) {
				$this->D[$module]='';
				$this->common->load_module(strtolower($module));
			}
		}
		foreach ($VALUES[0] as $VALUE) {
			$value = substr($VALUE,1,-1);
			if (!isset($this->D[$value])) {
				$this->D[$value]='';
			}
		}
		$this->D['TPL'] = $tpl_name;
	}

	// Выводит проработанный шаблон на экран ------------------------------------ 
	//
	function print_page() {
		$this->parser->parse('templates/'.$this->D['TPL'], $this->D);
	}

	// Выводит проработанный шаблон на экран ------------------------------------ 
	//
	function clear($label) {
		$this->D[$label]='';
	}

	function kill($label) {
		unset($this->D[$label]);
	}

	function assign($label, $value='') {
		if (is_array($label)) {
			foreach ($label as $l=>$v) {
				$this->D[$l]=$v;
			}
		} else
			$this->D[$label]=$value;
	}
}