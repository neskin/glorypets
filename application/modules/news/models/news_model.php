<?php

class News_model extends Modelbase {

	//private $tables = array('news', 'newsinfo', 'news_newsgroup_synh');
	
	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //
	public function get_top_news($limit_old = 0) {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		if($limit_old == 0)
			$limit = 4;
		else
			$limit = 3;
		
		$sql 	= "SELECT * FROM `news` 
					WHERE `news_status` = ? 
					GROUP BY `news_id`
					ORDER BY `news_view` DESC
					LIMIT $limit_old, $limit";		
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	public function get_last_news($limit_old = 0) {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		$limit = 3;
		
		$sql 	= "SELECT * FROM `news` 
					WHERE `news_status` = ? 
					GROUP BY `news_id`
					ORDER BY `news_time` DESC
					LIMIT $limit_old, $limit";		
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	public function get_block_news() {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$result = array();
		$limit = 3;
		$current = getDate(time()); 
       	$today = time() - (($current['hours']*3600)+($current['minutes']*60)+$current['seconds']);	// начало этого дня!
       	$yesteday = $today - 86400;
       	$befyesteday =  $today - 86400*2;
		
		$sql 	= "SELECT `news_name`, `news_id` FROM `news` 
					WHERE `news_status` = ?
					AND `news_time` >= '$today' 
					AND `news_time` < '$today' + 86400 
					GROUP BY `news_id`
					ORDER BY `news_view` DESC
					LIMIT $limit";		
		$rows = $this->db->query($sql, array(1));
		$result['today'] = $rows->result_array();
		
		$sql 	= "SELECT `news_name`, `news_id` FROM `news` 
					WHERE `news_status` = ?
					AND `news_time` >= '$yesteday' 
					AND `news_time` < '$today' 
					GROUP BY `news_id`
					ORDER BY `news_view` DESC
					LIMIT $limit";		
		$rows = $this->db->query($sql, array(1));
		$result['yesteday'] = $rows->result_array();
		//print_r($result);  die();
		
		
		$sql 	= "SELECT `news_name`, `news_id` FROM `news` 
					WHERE `news_status` = ?
					AND `news_time` >= '$befyesteday' 
					AND `news_time` < '$yesteday' 
					GROUP BY `news_id`
					ORDER BY `news_view` DESC
					LIMIT $limit";		
		$rows = $this->db->query($sql, array(1));
		$result['befyesteday'] = $rows->result_array();
		
		// Записываю дату! -----------------------------------------------
		$today = transform_time($today);
		$yesteday = transform_time($yesteday);
		$befyesteday = transform_time($befyesteday);
		$result['date']['today'] = $today;
		$result['date']['yesteday'] = $yesteday;
		$result['date']['befyesteday'] = $befyesteday;
		
		return $result;
	}
	
	
	
	
	
	
	// < ------------------ Back End ------------------ > //
	
	public function get_list() {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		$sql 	= "SELECT * FROM `news` 
					LEFT JOIN `news_category` ON `news_catid` = `news_category_id` 
					WHERE `news_status` != ? 
					GROUP BY `news_id`
					ORDER BY `news_time` DESC";		
		$rows = $this->db->query($sql, array('-1'));
		return $rows->result_array();
	}
	
	
	
	public function get_single($id) {

		$sql 	= "SELECT * FROM `news` 
					LEFT JOIN `news_category` ON `news_catid` = `news_category_id` 
					WHERE `news_status` != ? 
					AND `news_id` = ?
					GROUP BY `news_id`
					ORDER BY `news_time` DESC
					LIMIT 1";
		$rows = $this->db->query($sql, array('-1', $id));
		return $rows->row_array();
	}
	
	
	
	public function get_category() {
		$sql 	= "SELECT * FROM `news_category` 
					WHERE `news_category_status` = ? 
					GROUP BY `news_category_id`
					ORDER BY `news_category_position` ASC";
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	
	public function update($id) {
       // $this->db->where('news_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// Save news --------------------------------------------- >
		//
		$f  = array('news_name', 'news_time', 'news_description', 'news_text',  'news_catid');
		$dv = array('news_time'=>time());
		$n  = array('news_name', 'news_description', 'news_catid');
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'news/edititem/'.$id.'/');
		}
		
		$ar['news_name'] 		= addslashes(strip_tags($ar['news_name']));
		$ar['news_description'] = addslashes(strip_tags($ar['news_description']));
		$ar['news_time'] 		= transform_time($ar['news_time']);

		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `news` SET ".implode(", ", $ar)." WHERE `news_id` = $id";
		$this->db->query($sql);
		
		/*
        $this->newsinfo_about 	= $this->input->post('newsinfo_about');
        //$this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save() {
		$id = $this->get_value('news', 'news_id', '`news_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		$pos = $this->get_value('news', 'news_position', '`news_position` DESC');
		if(empty($pos))	
			$pos = 0;
		$pos ++;
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array('news_id', 'news_name', 'news_catid', 'news_description', 'news_position', 'news_text', 'news_image', 'news_time', 'news_status');
		$dv = array('news_id'=>$id, 'news_position'=>$pos, 'news_image'=>'', 'news_time'=>time(), 'news_description'=>'', 'news_status'=>1);
		$n  = array('news_name', 'news_description', 'news_catid');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			echo $id; die();
			$this->session->set_newsdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'news/newnews/');
		}

		$ar['news_name'] 		= addslashes(strip_tags($ar['news_name']));
		$ar['news_description'] = addslashes(strip_tags($ar['news_description']));
		$ar['news_time'] 		= transform_time($ar['news_time']);
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `news` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
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