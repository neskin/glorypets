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
		
		$sql 	= "SELECT * FROM `".$type."_category` 
					WHERE `".$type."_category_status` != ? 
					GROUP BY `".$type."_category_id`
					ORDER BY `".$type."_category_id` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	
	
	public function get_single($type, $id) {

		$sql 	= "SELECT * FROM `".$type."_category` 
					WHERE `".$type."_category_status` != ? 
					AND `".$type."_category_id` = ? 
					GROUP BY `".$type."_category_id`
					ORDER BY `".$type."_category_id` DESC
					LIMIT 1";	
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	public function update($type, $id) {
       // $this->db->where('news_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Save news --------------------------------------------- >
		//
		$f  = array($type.'_category_name', $type.'_category_text');
		$dv = array();
		$n  = array($type.'_category_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'category/edititem/'.$type.'/'.$id.'/');
		}
		
		$ar[$type.'_category_name'] 		= addslashes(strip_tags($ar[$type.'_category_name']));
		$ar[$type.'_category_text'] 		= addslashes(strip_tags($ar[$type.'_category_text']));

		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `".$type."_category` SET ".implode(", ", $ar)." WHERE `".$type."_category_id` = $id";
		$this->db->query($sql);
		
		/*
        $this->newsinfo_about 	= $this->input->post('newsinfo_about');
        //$this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save($type) {
		$id = $this->get_value($type.'_category', $type.'_category_id', '`'.$type.'_category_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		$pos = $this->get_value($type.'_category', $type.'_category_position', '`'.$type.'_category_position` DESC');
		if(empty($pos))	
			$pos = 0;
		$pos ++;
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array($type.'_category_id', $type.'_category_name', $type.'_category_position', $type.'_category_text', $type.'_category_status');
		$dv = array($type.'_category_id'=>$id, $type.'_category_position'=>$pos, $type.'_category_status'=>1);
		$n  = array($type.'_category_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			echo $id; die();
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'category/newitem/'.$type);
		}

		$ar[$type.'_category_name'] 		= addslashes(strip_tags($ar[$type.'_category_name']));
		$ar[$type.'_category_text'] 		= addslashes(strip_tags($ar[$type.'_category_text']));
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `".$type."_category` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
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