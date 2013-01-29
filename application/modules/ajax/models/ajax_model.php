<?php

class Ajax_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function get_some_rows($table, $number) {
		$query = $this->db->get($table, $number);
		return $query->result();
	}
	
	function insert_row($table) {
        $this->title   = $this->input->post('title');
        $this->content = $this->input->post('content');
        $this->date    = time();

        $this->db->insert($table, $this);
    }

    function update_row($table) {
        $this->title   = $this->input->post('title');
        $this->content = $this->input->post('content');
        $this->date    = time();

        $this->db->update($table, $this, array('id' => $this->input->post('id')));
    }
}

?>