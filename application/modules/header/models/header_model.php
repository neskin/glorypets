<?php

class Header_model extends Modelbase {
		
	public function __construct() {
		parent::__construct();
	}
	
	// < ------------------ Front End ------------------ > //
	public function index() {
		$sql 	= "SELECT * FROM `news` 
					WHERE `news_status` = ? 
					GROUP BY `news_id`
					ORDER BY `news_view` ASC
					LIMIT 9";		
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	
	
	
	
	// < ------------------ Back End ------------------ > //
	
	public function get_userlist($groupid = 1) {
		//$rows = $this->db->get($table, $number);
		//$rows = $rows->row_array();
		
		if(is_numeric($groupid) && $groupid > 0)
			$groupid = " AND `usergroup_id` = '$groupid' ";
		else 
			$groupid = "";
		
		$sql 	= "SELECT * FROM `user` 
					LEFT JOIN `user_usergroup_synh` ON `synh_user_id` = `user_id` 
					LEFT JOIN `usergroup` ON `usergroup_id` = `synh_usergroup_id` 
					WHERE `usergroup_status` = ? 
					AND `user_status` != ?
					$groupid 
					GROUP BY `user_id`
					ORDER BY `user_id` ASC";		
		$rows = $this->db->query($sql, array(1, '-1'));
		return $rows->result_array();
	}
	
	public function get_user($id) {

		$sql 	= "SELECT * FROM `user` 
					LEFT JOIN `user_usergroup_synh` ON `synh_user_id` = `user_id` 
					LEFT JOIN `usergroup` ON `usergroup_id` = `synh_usergroup_id` 
					LEFT JOIN `userinfo` ON `userinfo_id` = `user_id` 
					WHERE `usergroup_status` = ? 
					AND `user_status` != ? 
					AND `user_id` = ? 
					GROUP BY `user_id`
					ORDER BY `user_id` ASC
					LIMIT 1";		
		$rows = $this->db->query($sql, array(1, '-1', $id));
		return $rows->row_array();
	}
	
	public function get_usergroups() {
		
		$sql 	= "SELECT * FROM `usergroup` 
					WHERE `usergroup_status` = ? 
					ORDER BY `usergroup_position` ASC";
		$rows = $this->db->query($sql, array(1));
		return $rows->result_array();
	}
	
	
	public function get_usergroups_selected($id) {
		
		$sql 	= "SELECT * FROM `user_usergroup_synh` 
					WHERE `synh_user_id` = ? 
					ORDER BY `synh_usergroup_id` ASC";
		$rows = $this->db->query($sql, array($id));
		return $rows->result_array();
	}
	
	
	public function update_user($id) {
		/*$data_for_update = array(
			'user_login' 	=> $this->input->post('user_login'),
			'user_password' => $this->input->post('user_password'),
			'user_email' 	=> $this->input->post('user_email')
        );
        $this->db->where('user_id', $id)->update($this->tables[0], $data_for_update);*/
		
		// ��� ������� iser --------------------------------------------- >
		//
		$f  = array("user_login", "user_password", "user_email", "user_time_update");
		$dv = array("user_time_update"=>time());
		$n  = array("user_login", "user_password", "user_email");
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'user/edituser/'.$id.'/');
		}
		
		$ar['user_login'] 		= addslashes(strip_tags($ar['user_login']));
		$ar['user_password'] 	= addslashes(strip_tags($ar['user_password']));
		$ar['user_email'] 		= addslashes(strip_tags($ar['user_email']));
		
		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `user` SET ".implode(", ", $ar)." WHERE `user_id` = $id";
		$this->db->query($sql);
		
		
		// ��� ������� iserinfo --------------------------------------------- >
		//
		$f  = array("userinfo_name", "userinfo_address",  "userinfo_phone",  "userinfo_text",  "userinfo_about");
		$dv = array();
		$n  = array();
		$ar = mafg($f, $dv, $n);
		if($ar == false) {
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'user/edit/'.$id.'/');
		}
		
		$ar 	= sp_k_v($ar);
		$sql 	= "UPDATE `userinfo` SET ".implode(", ", $ar)." WHERE `userinfo_id` = $id";
		$this->db->query($sql);
		
		// ��� ������� isergroup --------------------------------------------- >
		//
		$usergroups = $this->input->post('user_usergroups');
		$sql = "DELETE FROM `user_usergroup_synh` WHERE `synh_user_id` = '$id'";
		$this->db->query($sql);
		if(!empty($usergroups)) {
			foreach($usergroups as $k=>$v) {
				$sql = "INSERT INTO `user_usergroup_synh` (`synh_user_id`, `synh_usergroup_id`) VALUES ('$id', '$v')";
				$this->db->query($sql);
			}
		} else {
			$sql = "INSERT INTO `user_usergroup_synh` (`synh_user_id`, `synh_usergroup_id`) VALUES ('$id', '2')";
			$this->db->query($sql);
			
		}
		
		/*
        $this->userinfo_name 	= $this->input->post('userinfo_name');
        $this->userinfo_address = $this->input->post('userinfo_address');
        $this->userinfo_phone 	= $this->input->post('userinfo_phone');
        $this->userinfo_text 	= $this->input->post('userinfo_text');
        $this->userinfo_about 	= $this->input->post('userinfo_about');
        $this->date    = time();
        $this->db->update($table, $this, array('id' => $this->input->post('id')));
		*/
		return 1;
	}
	
	
	public function save_user() {
		$id = $this->get_value('user', 'user_id', '`user_id` DESC');
		if(empty($id))	
			$id = 0;
		$id ++;
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array('user_id', 'user_login', 'user_password', 'user_email', 'user_time_register', 'user_time_update', 'user_status');
		$dv = array('user_id'=>$id, 'user_time_register'=>time(), 'user_time_update'=>time(), 'user_status'=>1);
		$n  = array('user_login', 'user_password', 'user_email');
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			echo $id; die();
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'user/newuser/');
		}

		$ar['user_login'] 		= addslashes(strip_tags($ar['user_login']));
		$ar['user_password'] 	= addslashes(strip_tags($ar['user_password']));
		$ar['user_email'] 		= addslashes(strip_tags($ar['user_email']));
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `user` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
			$this->db->query($sql);
		//}
		
		// ---------------------------------------------------------------------- >
		//
		$f  = array("userinfo_id", "userinfo_name", "userinfo_image", "userinfo_address",  "userinfo_phone",  "userinfo_text",  "userinfo_about");
		$dv = array("userinfo_id"=>$id);
		$n  = array();
		$ar = mafg($f, $dv, $n);
		if($ar == false){
			echo $id; die();
			$this->session->set_userdata('admin_msg', 'not_save');
			$_POST['submit'] = 0;
			redirect(HOSTADMIN.'user/newuser/');
		}

		foreach($ar as $k=>$v) {
			$ar[$k] = addslashes(strip_tags($v));
		}
		
		$f  = ekr($f, "`"); 
		$ar = ekr($ar, "'"); 
		
		//foreach($GLOBALS['langs_list'] as $v) {
			$sql 	= "INSERT INTO `userinfo` (".implode(", ", $f).") VALUES (".implode(", ", $ar).")";
			$this->db->query($sql);
		//}
		
		// ��� ������� isergroup --------------------------------------------- >
		//
		$usergroups = $this->input->post('user_usergroups');
		$sql = "DELETE FROM `user_usergroup_synh` WHERE `synh_user_id` = '$id'";
		$this->db->query($sql);
		if(!empty($usergroups)) {
			foreach($usergroups as $k=>$v) {
				$sql = "INSERT INTO `user_usergroup_synh` (`synh_user_id`, `synh_usergroup_id`) VALUES ('$id', '$v')";
				$this->db->query($sql);
			}
		} else {
			$sql = "INSERT INTO `user_usergroup_synh` (`synh_user_id`, `synh_usergroup_id`) VALUES ('$id', '2')";
			$this->db->query($sql);
			
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