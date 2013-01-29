<?php
class user_controller extends main_lib{
	//------------------------------------------------------------------------------
	function __construct(){
		$action = get(2);
		switch($action){
			case null:
				break;
			case 'register':
				$this->run_modul('register')->register();
				break;
			case 'auth_dialog':
				$this->run_modul('auth')->auth_dialog();
				break;
			case 'log_out':
				$this->run_modul('auth')->log_out();
				break;
			case 'auth':
				$l = addslashes(strip_tags(trim($_POST['user_email'])));
				$p = addslashes(strip_tags(trim($_POST['user_password'])));
				if($l == null || $p == null){
					$_SESSION['pop_up_msg'] = 'auth_fail';
					go_to($_SESSION['go_back_page']);
				}
				$this->run_modul('auth')->auth($l, $p);
				break;
			default: 
				$this->show_404_page();
				break;
		} 
		
	}
	//------------------------------------------------------------------------------
}
?>