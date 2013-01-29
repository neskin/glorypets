<?php
class User extends MX_Controller {
	//------------------------------------------------------------------------------
	function __construct(){
		parent::__construct();
		//$this->load->database();
		//$DB1 = $this->load->database($db['default'], TRUE);
		//$DB2 = $this->load->database('group_two', TRUE);
	}
	
	function index(){
		$this->load->module('topics/admin');
		$this->admin->index(); 
		
		$data = array(
			'title' => 'Главная',
			'header' => 'Хеддер. Frontend',
			'message' => 'Сообщение:'
        );
		
		$this->load->model('Main_model');
		$data['topics'] = $this->Main_model->get_some_rows('topics', '10');
		
		//$this->load->view('header.php');
		//$this->load->view('main_page.php', $data);
		//$this->load->view('footer.php');
	}
	
	//------------------------------------------------------------------------------
	//
	function main_list(){
		
		echo 1;
		/*
		if($new == 1)
			$_SESSION['roulette_end_game'] = 1;
		
		if($_SESSION['roulette_end_game'] != null || empty($_SESSION['roulette_user_uid']) || empty($_SESSION['roulette_user_global']) || empty($_SESSION['roulette_user_friends'])) {
			$this->reload_cookies();
			$this->facebook_get_user_info();
		}
		*/
		
		//$this->show_site('page_main.php', array('friends_list'=>$_SESSION['roulette_user_friends']));
		
	}
	
	//------------------------------------------------------------------------------
	//
	function news_single($news){
		//db::Query("UPDATE `news` SET `news_look` = (`news_look` + 1) WHERE `news_id` = '".$news['news_id']."'");
		$this->show_site('news_single.php', array('news'=>$news));
	}
	
	//------------------------------------------------------------------------------
}
?>