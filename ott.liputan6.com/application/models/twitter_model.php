<?php
class Twitter_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->DB_WRITE = $this->load->database('db_lip6_write', true);
	}

	public function addUser($data)
	{
		$data_add = array( 
			'source' 		=> $data['source']
			,'lookup' 		=> $data['lookup']
			,'password' 	=> $data['password']
			,'id_profile' 	=> $data['id_profile']
		);
		$this->DB_WRITE->insert('member_credentials', $data_add);
		
		$id_credential = $this->DB_WRITE->insert_id();
		
		$data_add['id_credential'] = $id_credential;
		
		return $data_add;
	}

	public function findByLookup($data)
	{
		$sql = $this->DB_WRITE->get_where('member_credentials', array(
											'lookup' => $data['lookup'], 
											'source' => $data['source']
											));
		return $sql->row_array(); 
	}

}