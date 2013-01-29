<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Adminbase {

	public function __construct() {
		parent::__construct();
		//$this->load->model('ajax_model');
		$this->load->helper('functions');
	}
	
	//------------------------------------------------------------------------------
	public function save_position($table = "", $field_change = "", $field_id = "", $ids = ""){
		$table 			= $this->input->post('table');
		$field_change 	= $this->input->post('field_change');
		$field_id 		= $this->input->post('field_id');
		$ids 			= $this->input->post('ids');
	
		if(empty($table) || empty($field_change) || empty($field_id) || empty($ids)) {
			echo 0; die();
		}
		
		$ids = explode(",", $ids);
		if(!is_array($ids) || empty($ids)) {
			echo 0; die();
		}
			
		for($i = 1; $i <= count($ids); $i++) {
			$sql = "UPDATE `$table` SET `$field_change` = ? WHERE `$field_id` = ?";
			$this->db->query($sql, array($i, $ids[$i-1]));
		}
		
		echo 1;
	}
	
	
	//------------------------------------------------------------------------------
	public function change_status($table = "", $field_change = "", $field_id = "", $id = "", $status = "") {
		$table 			= $this->input->post('table');
		$field_change 	= $this->input->post('field_change');
		$field_id 		= $this->input->post('field_id');
		$id 			= $this->input->post('id');
		$status 		= $this->input->post('status');
		
		if(empty($table) || empty($field_change) || empty($field_id) || empty($id) || !is_numeric($id)) {
			echo 0; die();
		}
		
		$status = abs($status - 1);	
		
		$sql = "UPDATE `$table` SET `$field_change` = ? WHERE `$field_id` = ?";
		$this->db->query($sql, array($status, $id));
		
		echo 1;
	}
	
	
	//------------------------------------------------------------------------------
	public function delete_element($table = "", $field_id = "", $field_pid = "", $field_status = "", $id = ""){
		$table 			= $this->input->post('table');
		$field_id 		= $this->input->post('field_id');
		$field_pid 		= $this->input->post('field_pid');
		$field_status 	= $this->input->post('field_status');
		$id 			= $this->input->post('id');

		$sql = "UPDATE `$table` SET `$field_status` = ? WHERE `$field_id` IN (?)";
		$this->db->query($sql, array('-1', $id));
		
		if($field_pid != null) {
			$sql = "SELECT * FROM `$table` WHERE `$field_id` IN (?) AND `$field_status` != ?";
			$ids = $this->db->query($sql, array($id, '-1'));
			$ids = array_unique(ma($ids, $field_id));
			if(!empty($ids))
				$this->delete_element($table, $field_id, $field_pid, $field_status, implode(", ", $ids));
		}
		
		echo 1;
	}
	//------------------------------------------------------------------------------
	
	
}
?>