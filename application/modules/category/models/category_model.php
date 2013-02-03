<?php

class Category_model extends Modelbase {

	//private $tables = array('news', 'newsinfo', 'news_newsgroup_synh');
	
	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //

	
	
	// < ------------------ Back End ------------------ > //
	
	public function get_list($type) {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$sql 	= "SELECT * FROM `".$type."category` 
					WHERE `".$type."category_status` != ? 
					GROUP BY `".$type."category_id`
					ORDER BY `".$type."category_id` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	
	
	public function get_single($type, $id) {

		$sql 	= "SELECT * FROM `".$type."category` 
					WHERE `".$type."category_status` != ? 
					AND `".$type."category_id` = ? 
					GROUP BY `".$type."category_id`
					ORDER BY `".$type."category_id` DESC
					LIMIT 1";	
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	public function update($type, $id) {
       // $this->db->where('news_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Save news --------------------------------------------- >
		//
		$f  = array($type.'category_name', $type.'category_text');
		$dv = array();
		$n  = array($type.'category_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'category/edititem/'.$type.'/'.$id.'/');
		}
		
		$ar[$type.'category_name'] 		= addslashes(strip_tags($ar[$type.'category_name']));
		$ar[$type.'category_text'] 		= addslashes(strip_tags($ar[$type.'category_text']));

		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `".$type."category` SET ".implode(", ", $ar)." WHERE `".$type."category_id` = $id";
		$this->db->query($sql);
		
		/*
        $this->newsinfo_about 	= $this->input->post('newsinfo_about');
        //$this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save($type) {
		$id = $this->get_value($type.'category', $type.'category_id', '`'.$type.'category_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		$pos = $this->get_value($type.'category', $type.'category_position', '`'.$type.'category_position` DESC');
		if(empty($pos))	
			$pos = 0;
		$pos ++;
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array($type.'category_id', $type.'category_name', $type.'category_position', $type.'category_text', $type.'category_status');
		$dv = array($type.'category_id'=>$id, $type.'category_position'=>$pos, $type.'category_status'=>1);
		$n  = array($type.'category_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			echo $id; die();
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'category/newitem/'.$type);
		}

		$ar[$type.'category_name'] 		= addslashes(strip_tags($ar[$type.'category_name']));
		$ar[$type.'category_text'] 		= addslashes(strip_tags($ar[$type.'category_text']));
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `".$type."category` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
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