<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------- Вход в админку проекта ---------------
class Main extends MX_Controller {
	
	public function __construct() {
		$this->modules = array('auth','cabinet','ads','news', 'glossary'); // разрешенные модули
		$this->load->helper(array('html', 'form', 'url'));
		$this->load->library('form_validation');
	}
	
	
	// --------------- Главная страница сайта ---------------
	//
	public function index() {		
		session_start();  			// сессии я использую, хотя базовый CI нет
	    $this->check_lang();  		// проверяет язык из урла
	    $this->check_module();  	// проверяет модуль из урла
	    $this->tp->load_tpl($this->tp->tpl); // загружает шаблон и проверяет на модули
	    $this->tp->print_page(); // выводит шаблон с проработанными модулями на экран
		//redirect(HOSTADMIN.$this->config->item('admin_def_module'));
	}
	
	
	// --------------- Проверить язык ---------------
	//
	function check_lang() {
		if ($s=$this->uri->segment(1)) {
	    	switch ($s) {
				case 'ru': 
					define('LANG','ru'); 
					break;
				case 'en': 
					define('LANG','en'); 
					$this->config->set_item('language', 'english'); 
					break;  
				default: 
					show_404('page');
			}    
		} else {
			define('LANG','ru');
		}
	}
	
	// --------------- Проверить модуль ---------------
	//
	function check_module() {
        if ($curModule = $this->uri->segment(2)) {
			if (in_array($curModule, $this->modules)) {
                $this->common->load_module($curModule);
                $this->tp->tpl = $this->$curModule->tpl;
            } else {
                show_404('page');   
            }
        } else {
            $this->load_main_page(); // Если нет второго сегмента, то загружает главную страницу
        }
    }
	// -------------------------------------
}