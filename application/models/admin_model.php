<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function check_some_rows($table, $number) {
		$query = $this->db->get($table, $number);
		return $query->result();
	}
}
