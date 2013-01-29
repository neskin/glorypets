<?php
class Common extends CI_Model {
	// Загружает модуль $module и функцию index() в нем
	//
	function load_module($module, $func = '') {
		if (is_dir('application/modules/'.$module)) { // проверяет, существует ли модуль
			$this->load->module($module);
			$this->$module->index();
		}
	}
}