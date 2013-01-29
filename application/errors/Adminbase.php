<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------- Базовый Admin-класс. Все Admin-классы всех модулей наследуют его ---------------
class Adminbase extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html', 'form', 'url', 'admin_panel', 'functions'));
		$this->load->library('form_validation');
		//if(!$this->_is_login())
		//	redirect(HOSTADMIN);
	}
	
	
	// --------------- Проверка авторизации ---------------
	//
	protected function _is_login() {
		if($this->session->userdata('admin_auth') == 1)
			return true;
		elseif(get_cookie('admin_auth_code') && get_cookie('admin_id')) {

			// Запрос Active Record !!!
			//$admin = $this->db->from('user')->join('user_usergroup_synh', 'synh_user_id = user_id', 'left')->join('usergroup', 'usergroup_id = synh_usergroup_id', 'left')->where(array('usergroup_status' => '1', 'usergroup_type'=>'admin', 'user_auth_code'=>get_cookie('admin_auth_code'), 'user_id'=>get_cookie('admin_id'), 'user_status' => '1'))->limit(1)->get();
			$sql 	= "SELECT * FROM `user` 
						LEFT JOIN `user_usergroup_synh` ON `synh_user_id` = `user_id` 
						LEFT JOIN `usergroup` ON `usergroup_id` = `synh_usergroup_id` 
						WHERE `usergroup_status` = ? 
						AND `usergroup_type` = ? 
						AND `user_auth_code` = ? 
						AND `user_id` = ? 
						AND `user_status` = ? 
						LIMIT 1";
			$admin = $this->db->query($sql, array(1, 'admin', get_cookie('admin_auth_code'), get_cookie('admin_id'), 1));
			
			if($admin->num_rows() > 0) {
				$admin = $admin->row_array();
				
				$this->session->set_userdata(array(
					'admin_auth'=>1, 
					'admin_id'=>$admin['admin_id'], 
					'admin_login'=>$admin['admin_login']
				));
				return true;
			} else {
				delete_cookie('admin_auth_code');
				delete_cookie('admin_id');
			}
		} else
			return false;
	}
	
	// --------------- Построение меню в админке ---------------
	//
	final public function _render($view = 'index', $data = array()) {
		$menu['leftmenu'] = $this->config->item('leftside_menu');
		/*$menu['top'] = $this->menu_model->get_top_menu();
		$menu['cats'] = $this->category_model->get_list();
		$menu['tags'] = $this->tag_model->get_list();
		$menu['last_comments'] = $this->comment_model->get_last(10);
		$menu['links'] = $this->link_model->get_list();
		$menu['month_pages'] = $this->page_model->get_month_list();
		$menu['top_pages'] = $this->page_model->get_top(10);
		$menu['top_comments'] = $this->comment_model->get_top(10);*/
 
		$this->load->view('admin/header', $menu);
		if(is_array($view)) {
			foreach($view as $k=>$v) {
				$this->load->view($v, $data);
			}
		} else {
			$this->load->view($view, $data);
		}
		$this->load->view('admin/footer', $menu);
	}
}