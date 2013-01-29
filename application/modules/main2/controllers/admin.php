<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ---------- Админ-класс модуля ------------
class Admin extends Adminbase {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['check'] = array('bla'=>'bla-bla-bla');
		$this->_render('admin/index', $data);
	}
}
?>