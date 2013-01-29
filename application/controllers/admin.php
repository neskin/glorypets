<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------- Вход в админку проекта ---------------
class Admin extends Adminbase {
	
	public function __construct() {
		$this->load->helper(array('html', 'form', 'url', 'admin_panel'));
		$this->load->library('form_validation');
	}	
	
	
	// --------------- Страница входа в админку ---------------
	//
	public function index() {		
		if(!$this->_is_login()) {
			$this->form_validation->set_rules('login', 'Login', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE)	{
				$this->load->view('admin/login');
			}
		} else {
			redirect(HOSTADMIN.$this->config->item('admin_def_module'));
		}
	}
	
	
	// --------------- Авторизация ---------------
	//
	public function login() {
		$login 		= $this->input->post('login');
		$password 	= $this->input->post('password');
		$remember 	= $this->input->post('remember');
		
		//Запрос Active Record !!!
		//$a = $this->db->from('user')->join('user_usergroup_synh', 'synh_user_id = user_id', 'left')->join('usergroup', 'usergroup_id = synh_usergroup_id', 'left')->where(array('usergroup_status' => '1', 'usergroup_type'=>'admin', 'user_login'=>$login, 'user_password'=>$password, 'user_status' => '1'))->limit(1)->get();
		$sql 	= "SELECT * FROM `user` 
					LEFT JOIN `user_usergroup_synh` ON `synh_user_id` = `user_id` 
					LEFT JOIN `usergroup` ON `usergroup_id` = `synh_usergroup_id` 
					WHERE `usergroup_status` = ? 
					AND `usergroup_type` = ? 
					AND `user_login` = ?  
					AND `user_password` = ? 
					AND `user_status` = ? 
					LIMIT 1";
		$a = $this->db->query($sql, array(1, 'admin', $login, $password, 1));
		$a = $a->row_array();
		//print_r($a['user_login']); die();
		if(empty($a)) {
			echo 0;
			die();
		}
		
		$code = md5(time().rand(1, 1000).$login);

		
		//Запрос Active Record !!!
		//$this->db->set(array('user_auth_code'=>$code))->where(array('user_id'=>$a['user_id']))->update('user');
		$sql = "UPDATE `user` SET `user_auth_code` = ? WHERE `user_id` = ?";
		$this->db->query($sql, array($code, $a['user_id']));
		$this->session->set_userdata(array(
			'admin_login'=>$a['user_login'],
			'admin_id'=>$a['user_id'], 
			'admin_auth'=>1
		));

		if($remember == 1) {
			set_cookie(array(
				'name'=>'admin_auth_code', 
				'value'=>$code, 
				'expire'=>time()+604800, 
				'path'=>'/', 
				'prefix'=>''
			));
			set_cookie(array(
				'name'=>'admin_id', 
				'value'=>$a['user_id'], 
				'expire'=>time()+604800, 
				'path'=>'/', 
				'prefix'=>''
			));
		}

		echo 1;
		die();
	}
	
	// --------------- Выход ---------------
	//
	public function logout(){
		delete_cookie('admin_auth_code');
		delete_cookie('admin_id');
		$this->session->unset_userdata(array(
			'admin_auth'=>'',
			'admin_id'=>'',
			'admin_login'=>''
		));
		redirect(HOSTADMIN);
	}
	// -------------------------------------
}