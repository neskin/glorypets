<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Adminbase {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() {
		$groupid = $this->input->post('groupid');
		$data['userlist'] = $this->user_model->get_userlist($groupid);
		$data['userlist'] = tt_in_a($data['userlist'], 'user_time_register', true);
		$data['usergroups'] = $this->user_model->get_usergroups();
		$this->_render('admin/list', $data);
	}

	public function newuser() {
		$this->form_validation->set_rules('user_login', 'Login', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('user_email', 'E-mail', 'trim|required|valid_email');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			$data['usergroups'] = $this->user_model->get_usergroups();
			$this->_render('admin/new', $data);
		} else {
			$this->_save();
		}
	}
	
	public function edituser($id = 0) {
		if($id == null || !is_numeric($id)) {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'user/');
		}
		
		$this->form_validation->set_rules('user_login', 'Login', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('user_email', 'E-mail', 'trim|required|valid_email');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			$data['user'] = $this->user_model->get_user($id);
			$data['usergroups'] = $this->user_model->get_usergroups();
			$data['usergroups_s'] = $this->user_model->get_usergroups_selected($id);
			$this->_render('admin/edit', $data);
		} else {
			$this->_update($id);
		}
	}
		
	private function _save() {
		$this->user_model->save_user();
		redirect(HOSTADMIN.'user/');
	}
	
	private function _update($id) {
		$this->user_model->update_user($id);
		redirect(HOSTADMIN.'user/');
	}
}