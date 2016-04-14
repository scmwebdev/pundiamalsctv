<?php
class Team_model extends CI_Model {
    
    var $table = 'gsm_team';
	public function __construct()
	{
		parent::__construct();
		$this->DB_WRITE = $this->load->database('db_lip6_write', true);
	}

    function get_all($limit,$offset){
		$this->DB_WRITE->limit($limit,$offset);
		$this->DB_WRITE->order_by('team_id','ASC');
		return $this->DB_WRITE->get($this->table)->result_array();		
	}
	
	function get_by_id($id){
		return $this->DB_WRITE->get_where($this->table,array('team_id'=>$id))->row();
	}
}
