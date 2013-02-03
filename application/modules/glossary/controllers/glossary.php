<?php
class Glossary extends MX_Controller {
	private $mname;
	public $tpl;
        public $alphabet = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Э', 'Ю', 'Я');


	function __construct() {
		$this->tpl = 'site.php'; 					// шаблон страницы
		$this->mname = strtolower(get_class());		// имя модуля
		$this->load->model($this->mname.'/'.$this->mname.'_model');		// загрузка модели
		$this->lang->load('glossary', 'russian');
                $this->tp->D['alphabet'] = $this->alphabet;
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
                $glossary_top = $this->$model->get_top_glossary();
		$this->tp->D['glossary_top'] = $glossary_top;
		
		$this->tp->parse('CONTENT', $this->mname.'/'.$this->mname.'.php');
	}
	
	public function single($id) {
		$model = $this->mname.'_model';				// переменная модели
		$single = $this->$model->get_single($id);
		$this->tp->D['single'] = $single;
		$character = $this->$model->get_single_character($id);
		$this->tp->D['character'] = $character;
		//print_r($this->tp->D); die();
		$this->tp->parse('CONTENT', $this->mname.'/single.php');
	}
	
	public function search() {
		$model = $this->mname.'_model';				// переменная модели
		$glossary = $this->$model->get_letter_search();
		$this->tp->D['glossary'] = $glossary;
		//print_r($this->tp->D); die();
                
		$this->tp->parse('CONTENT', $this->mname.'/search.php');
	}
}