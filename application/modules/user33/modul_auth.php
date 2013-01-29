<?php
class user_auth extends main_lib{
	//------------------------------------------------------------------------------
	function __construct(){
	}
	//------------------------------------------------------------------------------
	// Проверка авторизирован ли администратор
	public function is_auth(){
		if(isset($_SESSION['user_auth']) && $_SESSION['user_auth'] == 1)
			return true;
		elseif(!empty($_COOKIE['user_auth_code']) && !empty($_COOKIE['user_id'])){
			$user = db::Select("SELECT * FROM `user` WHERE `user_auth_code` = '".es($_COOKIE['user_auth_code'])."' AND `user_id` = '".es($_COOKIE['user_id'])."' AND `user_status` = 1 LIMIT 1", 2);
			if(!empty($user)){
				$_SESSION['user_auth']    = 1;
				$_SESSION['user_id']      = $user['user_id'];
				$_SESSION['user_email']   = $user['user_email'];
				$_SESSION['user_name']    = $user['user_name'];
				$_SESSION['user_phone']   = $user['user_phone'];
				$_SESSION['user_address'] = $user['user_address'];
				return true;
			}
			else{
				setcookie ("user_auth_code", "", time() - 3600, "/");
				setcookie ("user_id", "", time() - 3600, "/");
			}
		}
		else
			return false;
	}
	//------------------------------------------------------------------------------
	// Показ формы авторизации
	public function auth_dialog(){
		$this->show_tpl('auth_form.php');
	}
	//------------------------------------------------------------------------------
	public function auth($l, $p){
		$a = db::Select("SELECT * FROM `user` WHERE `user_email` = '".$l."' AND `user_password` = '".$p."' AND `user_status` = '1' LIMIT 1", 2);
		if(empty($a)){
			$_SESSION['pop_up_msg'] = 'auth_fail';
			go_to($_SESSION['go_back_page']);
		}
		
		$code = md5(time().rand(1, 1000).$l);
		
		db::Query("UPDATE `user` SET `user_auth_code` = '".$code."' WHERE `user_id` = '".$a['user_id']."'");
		$_SESSION['user_auth']    = 1;
		$_SESSION['user_id']      = $a['user_id'];
		$_SESSION['user_email']   = $a['user_email'];
		$_SESSION['user_name']    = $a['user_name'];
		$_SESSION['user_phone']   = $a['user_phone'];
		$_SESSION['user_address'] = $a['user_address'];
		
		if(p('remember_me') == 1){
			setcookie ("user_auth_code", $code, time() + 7*24*60*60, '/');
			setcookie ("user_id", $a['user_id'], time() + 7*24*60*60, '/');
		}
		
		setcookie('basket_id',	"", time() - 3600, '/');
		
		$_SESSION['pop_up_msg'] = 'auth_suc';
		go_to($_SESSION['go_back_page']);
	}
	//------------------------------------------------------------------------------
	public function log_out(){
		unset($_SESSION['user_auth']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_phone']);
		unset($_SESSION['user_address']);
		
		setcookie ("user_auth_code", "", time() - 3600, "/");
		setcookie ("user_id", "", time() - 3600, "/");
		
		$_SESSION['pop_up_msg'] = 'log_out';
		go_to($_SESSION['go_back_page']);
	}
	//------------------------------------------------------------------------------
}
?>