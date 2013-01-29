<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Adminbase {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('category_model');
	}
	
	public function catlist($type = '') {
		if($type == '') {
			$this->show_404();
		}
		$data['list'] = $this->category_model->get_list($type);
		$data['type'] = $type;
		$this->_render('admin/list', $data);
	}

	public function newitem($type = '') {
		if($type == '') {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'category/catlist/'.$type);
		}
		
		$this->form_validation->set_rules($type.'_category_name', 'Name', 'trim|required|min_length[3]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			$data['type'] = $type;
			$this->_render('admin/new', $data);
		} else {
			$this->_save($type);
		}
	}
	
	public function edititem($type = '', $id = 0) {
		if($id == null || !is_numeric($id) || $type == '') {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'category/catlist/'.$type);
		}
		
		$this->form_validation->set_rules($type.'_category_name', 'Name', 'trim|required|min_length[3]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			$data['single'] = $this->category_model->get_single($type, $id);
			$data['type'] = $type;
			$this->_render('admin/edit', $data);
		} else {
			$this->_update($type, $id);
		}
	}
		
	private function _save($type) {
		$this->category_model->save($type);
		redirect(HOSTADMIN.'category/catlist/'.$type);
	}
	
	private function _update($type, $id) {
		$this->category_model->update($type, $id);
		redirect(HOSTADMIN.'category/catlist/'.$type);
	}
}