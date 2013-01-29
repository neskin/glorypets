<?php

class Glossary_model extends Modelbase {

	//private $tables = array('glossary', 'glossaryinfo', 'glossary_glossarygroup_synh');
	
	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //
	public function get_glossary($limit_old = 0) {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		if($limit_old == 0)
			$limit = 15;
		else
			$limit = 3;
		
		$sql 	= "SELECT * FROM `glossary` 
					WHERE `glossary_status` = ? 
					GROUP BY `glossary_id`
					ORDER BY `glossary_id` DESC
					LIMIT $limit_old, $limit";		
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	public function get_block_glossary() {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$result = array();
		$limit = 1;
		
		$sql 	= "SELECT `glossary_name`, `glossary_id` FROM `glossary` 
					WHERE `glossary_status` = ?
					GROUP BY `glossary_id`
					ORDER BY `glossary_id` DESC
					LIMIT $limit";		
		$rows = $this->db->query($sql, array(1));
		$result = $rows->result_array();
		
		return $result;
	}
	
	
	
	
	
	
	// < ------------------ Back End ------------------ > //
	
	public function get_list() {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$sql 	= "SELECT * FROM `glossary` 
					LEFT JOIN `glossary_category` ON `glossary_catid` = `glossary_category_id` 
					WHERE `glossary_status` != ? 
					GROUP BY `glossary_id`
					ORDER BY `glossary_id` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	
	
	public function get_single($id) {

		$sql 	= "SELECT * FROM `glossary` 
					LEFT JOIN `glossary_category` ON `glossary_catid` = `glossary_category_id` 
					WHERE `glossary_status` != ? 
					AND `glossary_id` = ?
					GROUP BY `glossary_id`
					ORDER BY `glossary_id` DESC
					LIMIT 1";
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	
	
	public function get_category() {
		$sql 	= "SELECT * FROM `glossary_category` 
					WHERE `glossary_category_status` = ? 
					GROUP BY `glossary_category_id`
					ORDER BY `glossary_category_position` ASC";
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	
	public function update($id) {
       // $this->db->where('glossary_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Save glossary --------------------------------------------- >
		//
		$f  = array('glossary_name', 'glossary_description', 'glossary_text', 'glossary_catid');
		$dv = array();
		$n  = array('glossary_name', 'glossary_description');
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_glossarydata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'glossary/edititem/'.$id.'/');
		}
		
		$ar['glossary_name'] 		= addslashes(strip_tags($ar['glossary_name']));
		$ar['glossary_description'] = addslashes(strip_tags($ar['glossary_description']));

		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `glossary` SET ".implode(", ", $ar)." WHERE `glossary_id` = $id";
		$this->db->query($sql);
		
		/*
        $this->glossaryinfo_about 	= $this->input->post('glossaryinfo_about');
        //$this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save() {
		$id = $this->get_value('glossary', 'glossary_id', '`glossary_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		$pos = $this->get_value('glossary', 'glossary_position', '`glossary_position` DESC');
		if(empty($pos))	
			$pos = 0;
		$pos ++;
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array('glossary_id', 'glossary_name', 'glossary_catid', 'glossary_description', 'glossary_position', 'glossary_text', 'glossary_image', 'glossary_status');
		$dv = array('glossary_id'=>$id, 'glossary_position'=>$pos, 'glossary_image'=>'', 'glossary_description'=>'', 'glossary_status'=>1);
		$n  = array('glossary_name', 'glossary_description');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			$this->session->set_glossarydata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'glossary/newitem/');
		}

		$ar['glossary_name'] 		= addslashes(strip_tags($ar['glossary_name']));
		$ar['glossary_description'] = addslashes(strip_tags($ar['glossary_description']));
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `glossary` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
			$this->db->query($sql);
		//}
		
	}
	
	
	// ----------------------------------------------------
	
	public function insert_row($table) {
        $this->title   = $this->input->post('title');
        $this->content = $this->input->post('content');
        $this->date    = time();

        $this->db->insert($table, $this);
    }

    public function update_row($table) {
        $this->title   = $this->input->post('title');
        $this->content = $this->input->post('content');
        $this->date    = time();

        $this->db->update($table, $this, array('id' => $this->input->post('id')));
    }
}

?>