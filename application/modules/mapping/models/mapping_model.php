<?php

class Mapping_model extends Modelbase {

	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //
	
	
	public function get_mapping() {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$result = array();
                $glossary_id = $this->uri->segment(4);
                if(!is_numeric($glossary_id))
                    return false;
		
		$sql 	= "SELECT * FROM `glossarymapping` 
                            WHERE `glossarymapping_status` = ?
                            AND `glossarymapping_id` = ?
                            GROUP BY `glossarymapping_id`
                            ORDER BY `glossarymapping_id` DESC";		
		$rows = $this->db->query($sql, array(1, $glossary_id));
		$result = $rows->result_array();
		
		return $result;
	}
	
	
	
	
	
	
	// < ------------------ Back End ------------------ > //
	
	public function get_list() {		
		$sql 	= "SELECT * FROM `glossarymapping` 
                            LEFT JOIN `glossary` ON `glossarymapping_gid` = `glossary_id` 
                            WHERE `glossarymapping_status` != ? 
                            ORDER BY `glossary_name` ASC, `glossarymapping_id` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	public function get_glossary() {
		$sql 	= "SELECT `glossary_name`, `glossary_id` FROM `glossary` 
                            WHERE `glossary_status` = ? 
                            GROUP BY `glossary_id`
                            ORDER BY `glossary_id` DESC";		
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
        
	public function get_single($id) {
		$sql 	= "SELECT * FROM `glossarymapping` 
                            LEFT JOIN `glossary` ON `glossarymapping_gid` = `glossary_id` 
                            WHERE `glossarymapping_status` != ? 
                            AND `glossarymapping_id` = ?
                            GROUP BY `glossarymapping_id`
                            ORDER BY `glossarymapping_id` DESC
                            LIMIT 1";
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	
	public function update($id) {
       // $this->db->where('glossarymapping_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Update glossarymapping --------------------------------------------- >
		//
		$f  = array('glossarymapping_name', 'glossarymapping_style', 'glossarymapping_text');
		$dv = array();
		$n  = array('glossarymapping_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'mapping/edititem/'.$id.'/');
		}
		
		$ar['glossarymapping_name'] 	= addslashes(strip_tags($ar['glossarymapping_name']));

		$ar  = sp_k_v($ar);
		$sql = "UPDATE `glossarymapping` SET ".implode(", ", $ar)." WHERE `glossarymapping_id` = $id";
		$this->db->query($sql);
		
                
                // Update glossarymapping for all langs -------------------------------------------------------- >
		//
                $f  = array('glossarymapping_gid');
		$dv = array();
		$n  = array();
		$ar = mafg($f, $dv, $n);
                $ar 	= sp_k_v($ar);
                if(!empty($ar)) {
                        $sql = "UPDATE `glossarymapping` SET ".implode(", ", $ar)." WHERE `glossarymapping_id` = $id";
                        $this->db->query($sql);
                }
                        
		
                /*
                $this->glossarymappinginfo_about 	= $this->input->post('glossarymappinginfo_about');
                //$this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save() {
		$id = $this->get_value('glossarymapping', 'glossarymapping_id', '`glossarymapping_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		// Save mapping ---------------------------------------------- >
		//
		$f  = array('glossarymapping_id', 'glossarymapping_gid', 'glossarymapping_name', 'glossarymapping_style', 'glossarymapping_text', 'glossarymapping_status');
		$dv = array('glossarymapping_id'=>$id, 'glossarymapping_text'=>'', 'glossarymapping_status'=>1);
		$n  = array('glossarymapping_name');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
                        echo 1; die();
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'mapping/newitem/');
		}

		$ar['glossarymapping_name'] = addslashes(strip_tags($ar['glossarymapping_name']));
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `glossarymapping` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
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