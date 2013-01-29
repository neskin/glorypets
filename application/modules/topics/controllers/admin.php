<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Adminbase {
	
	public function __construct() {
		parent::__construct();	
	}
	
	public function index() {
		$this->load->view('admin/index');
	}
}
?>