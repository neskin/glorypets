<?php
class user_register extends main_lib{
	//------------------------------------------------------------------------------
	function __construct(){
	}
	//------------------------------------------------------------------------------
	public function register(){
		$f  = array('user_name', 'user_email', 'user_password', 'user_phone', 'user_address');
		$fn = array('user_name', 'user_email', 'user_password', 'user_phone', 'user_address');
		
		foreach($f as $v){
			if(isset($_POST[$v]))
				$res[$v] = "'".addslashes(strip_tags(trim($_POST[$v])))."'";
			else
				$res[$v] = "''";
		}
		
		$valyd = 1;
		
		foreach($fn as $v){
			if(empty($res[$v]))
				$valyd = 0;
		}
		
		if(!vm($res['user_email']))
			$valyd = 0;
		
		if($valyd = 0){
			$_SESSION['pop_up_msg'] = 'register_fail';
			go_to($_SESSION['go_back_page']);
		}
		
		$res['user_time_register'] = "'".time()."'";
		$f[] = '`user_time_register`';
		
		$res['user_status'] = "'1'";
		$f[] = '`user_status`';
		
		db::Query("INSERT INTO `user` (".implode(', ', $f).") VALUES (".implode(', ', $res).")");
		
		$_SESSION['pop_up_msg'] = 'register_suc';
		go_to($_SESSION['go_back_page']);

	}
	//------------------------------------------------------------------------------
	// Показ формы авторизации
	public function auth_dialog(){
		$this->show_tpl('auth_form.php');
	}
	//------------------------------------------------------------------------------
}
?>