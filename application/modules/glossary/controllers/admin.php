<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Adminbase {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('glossary_model');
	}
	
	public function index() {
		$data['list'] = $this->glossary_model->get_list();
		$data['list'] = tt_in_a($data['list'], 'glossary_time', false);
		$data['category'] = $this->glossary_model->get_category();
		$this->_render('admin/list', $data);
	}

	public function newitem() {
		$this->form_validation->set_rules('glossary_name', 'Name', 'trim|required|min_length[3]|xss_clean');
		//$this->form_validation->set_rules('glossary_catid', 'Category', 'trim|required');
		$this->form_validation->set_rules('glossary_description', 'Description', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			//$data['category'] = $this->glossary_model->get_category();
			$this->_render('admin/new');
		} else {
			$this->_save();
		}
	}
	
	public function edititem($id = 0) {
		if($id == null || !is_numeric($id)) {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'glossary/');
		}
		
		$this->form_validation->set_rules('glossary_name', 'Name', 'trim|required|min_length[3]|xss_clean');
		//$this->form_validation->set_rules('glossary_catid', 'Category', 'trim|required');
		$this->form_validation->set_rules('glossary_description', 'Description', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			$data['single'] = $this->glossary_model->get_single($id);
			//$data['category'] = $this->glossary_model->get_category();
			$this->_render('admin/edit', $data);
		} else {
			$this->_update($id);
		}
	}
		
	private function _save() {
		$this->glossary_model->save();
		redirect(HOSTADMIN.'glossary/');
	}
	
	private function _update($id) {
		$this->glossary_model->update($id);
		redirect(HOSTADMIN.'glossary/');
	}
}