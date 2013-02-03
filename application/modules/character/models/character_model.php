<?php

class Character_model extends Modelbase {

	//private $tables = array('news', 'newsinfo', 'news_newsgroup_synh');
	
	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //

	
	
	// < ------------------ Back End ------------------ > //
	
	public function get_list($type) {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$sql 	= "SELECT * FROM `".$type."character` 
					WHERE `".$type."character_status` != ? 
					GROUP BY `".$type."character_id`
					ORDER BY `".$type."character_id` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	
	
	public function get_single($type, $id) {

		$sql 	= "SELECT * FROM `".$type."character` 
					WHERE `".$type."character_status` != ? 
					AND `".$type."character_id` = ? 
					GROUP BY `".$type."character_id`
					ORDER BY `".$type."character_id` DESC
					LIMIT 1";	
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	public function update($type, $id) {
       // $this->db->where('news_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Save news --------------------------------------------- >
		//
		$f  = array($type.'character_name', $type.'character_text');
		$dv = array();
		$n  = array($type.'character_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'character/edititem/'.$type.'/'.$id.'/');
		}
		
		$ar[$type.'character_name'] 		= addslashes(strip_tags($ar[$type.'character_name']));
		$ar[$type.'character_text'] 		= addslashes(strip_tags($ar[$type.'character_text']));

		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `".$type."character` SET ".implode(", ", $ar)." WHERE `".$type."character_id` = $id";
		$this->db->query($sql);
		
		/*
        $this->newsinfo_about 	= $this->input->post('newsinfo_about');
        //$this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save($type) {
		$id = $this->get_value($type.'character', $type.'character_id', '`'.$type.'character_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		$pos = $this->get_value($type.'character', $type.'character_position', '`'.$type.'character_position` DESC');
		if(empty($pos))	
			$pos = 0;
		$pos ++;
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array($type.'character_id', $type.'character_name', $type.'character_position', $type.'character_text', $type.'character_status');
		$dv = array($type.'character_id'=>$id, $type.'character_position'=>$pos, $type.'character_status'=>1);
		$n  = array($type.'character_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			echo $id; die();
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'character/newitem/'.$type);
		}

		$ar[$type.'character_name'] 		= addslashes(strip_tags($ar[$type.'character_name']));
		$ar[$type.'character_text'] 		= addslashes(strip_tags($ar[$type.'character_text']));
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `".$type."character` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
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