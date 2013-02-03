<?php

class Mapping_model extends Modelbase {

	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //
	
	
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
		
		$sql 	= "SELECT * FROM `glossarymapping` 
					LEFT JOIN `glossary` ON `glossarymapping_gid` = `glossary_id` 
					WHERE `glossarymapping_status` != ? 
					ORDER BY `glossary_name` ASC, `glossarymapping_id` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	public function get_glossary() {
		$sql 	= "SELECT * FROM `glossary` 
                            WHERE `glossary_status` = ? 
                            GROUP BY `glossary_id`
                            ORDER BY `glossary_id` DESC";		
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
        
	public function get_single($id) {

		$sql 	= "SELECT * FROM `glossary` 
					LEFT JOIN `glossarycategory` ON `glossary_catid` = `glossarycategory_id` 
					WHERE `glossary_status` != ? 
					AND `glossary_id` = ?
					GROUP BY `glossary_id`
					ORDER BY `glossary_id` DESC
					LIMIT 1";
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	
	public function get_category() {
		$sql 	= "SELECT * FROM `glossarycategory` 
					WHERE `glossarycategory_status` = ? 
					GROUP BY `glossarycategory_id`
					ORDER BY `glossarycategory_position` ASC";
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
        
	public function get_character() {
		$sql 	= "SELECT * FROM `glossarycharacter` 
					WHERE `glossarycharacter_status` = ? 
					GROUP BY `glossarycharacter_id`
					ORDER BY `glossarycharacter_position` ASC";
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
        
        
	public function get_s_character($id) {
		$result = array();
                $sql 	= "SELECT * FROM `glossary_character_synh` 
                            WHERE `synh_glossary_id` = ? 
                            ORDER BY `synh_character_id` ASC";
		$rows = $this->db->query($sql, array($id));
                $rows = $rows->result_array();
                if(!empty($rows)) {
                    foreach($rows as $k=>$v) {
                        $result[$v['synh_character_id']] = $v['synh_rate'];
                    }
                }
		return $result;
	}
	
	
	public function update($id) {
       // $this->db->where('glossary_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Update glossary --------------------------------------------- >
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
		
                
                // Update characters -------------------------------------------------------- >
		//
                $sql = "DELETE FROM `glossary_character_synh` 
                        WHERE `synh_glossary_id` = ?";
                $this->db->query($sql, array($id));
                foreach($this->input->post('glossarycharacter') as $k=>$v) {
                    $sql = "INSERT INTO `glossary_character_synh` 
                            (`synh_glossary_id`, `synh_character_id`, `synh_rate`)
                            VALUES 
                            (?, ?, ?)";
                    $this->db->query($sql, array($id, $k, $v));
                }
                
                        
		
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
                        
                		
                
                // Update characters -------------------------------------------------------- >
		//
                $sql = "DELETE FROM `glossary_character_synh` 
                        WHERE `synh_glossary_id` = ?";
                $this->db->query($sql, array($id));
                foreach($this->input->post('glossarycharacter') as $k=>$v) {
                    $sql = "INSERT INTO `glossary_character_synh` 
                            (`synh_glossary_id`, `synh_character_id`, `synh_rate`)
                            VALUES 
                            (?, ?, ?)";
                    $this->db->query($sql, array($id, $k, $v));
                }
		
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