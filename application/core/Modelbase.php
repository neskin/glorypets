<?php 

class Modelbase extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('html', 'form', 'url', 'functions'));
	}
	
	public function check_some_rows($table, $number) {
		$query = $this->db->get($table, $number);
		return $query->result();
	}
	
	//------------------------------------------------------------------------------
	public function get_cfg($name)
	{
		$cfg = self::Select("SELECT `cfg_value` FROM `cfg` WHERE `cfg_name` = '".$name."'", 2);
		if(empty($cfg)) 
			return false;
		else{ $cfg[$name] = $cfg['cfg_value']; 
			return $cfg['cfg_value'];}
	}
	//------------------------------------------------------------------------------
	public function get_value($table, $field, $order = ''){
		if(!empty($order))
			$order = "ORDER BY ".$order;
		$sql = "SELECT `".$field."` FROM `".$table."` ".$order." LIMIT 1";
		$rows = $this->db->query($sql, array(1, '-1'));
		$val = $rows->row_array();

		if(empty($val))
			return array();
		else
			return $val[$field];
	}
	//------------------------------------------------------------------------------
	public function get_by_id($table, $field_id, $id, $lang_field = ''){
		if($lang_field != '')
			$lang_field = " AND `$lang_field` = '".cl()."'";
		return self::Select("SELECT * FROM `$table` WHERE `$field_id` = '$id'$lang_field LIMIT 1", 2);	
	}
	//------------------------------------------------------------------------------
}
