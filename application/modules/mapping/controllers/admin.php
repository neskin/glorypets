<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Adminbase {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('mapping_model');
	}
	
	public function index() {
		$data['list'] = $this->mapping_model->get_list();
		$this->_render('admin/list', $data);
	}

	public function newitem() {
		$this->form_validation->set_rules('glossarymapping_name', 'Name', 'trim|required|min_length[3]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
                        $data['glossary'] = $this->mapping_model->get_glossary();
			$this->_render('admin/new', $data);
		} else {
			$this->_save();
		}
	}
	
	public function edititem($id = 0) {
		if($id == null || !is_numeric($id)) {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'mapping/');
		}
		
		$this->form_validation->set_rules('glossarymapping_name', 'Name', 'trim|required|min_length[3]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$_POST['submit'] = 0;
			$data['single'] = $this->mapping_model->get_single($id);
			$data['glossary'] = $this->mapping_model->get_glossary();
			$this->_render('admin/edit', $data);
		} else {
			$this->_update($id);
		}
	}
		
	private function _save() {
		$this->mapping_model->save();
		redirect(HOSTADMIN.'mapping/');
	}
	
	private function _update($id) {
		$this->mapping_model->update($id);
		redirect(HOSTADMIN.'mapping/');
	}
}