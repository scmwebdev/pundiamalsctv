<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

# Agustus 2012
# by Wisnu Alamsyah
# www.alamsyah.org - vespagaul@gmail.com


class Core_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

	public function get_data($array)
	{
	    if (isset($array['table'])) {
	    	if (isset($array['select']))	$this->db->select($array['select']);
	    	if (isset($array['join']))		$this->db->join($array['join']);
    	    if (isset($array['where']))     $this->db->where($array['where']);
    	    if (isset($array['order_by']))  $this->db->order_by($array['order_by']);
    	    if (isset($array['group_by']))  $this->db->group_by($array['group_by']); 
    	    $this->db->from($array['table']);
    	    if (isset($array['data']) && $array['data'] == 'row') 
    	    	return $this->db->get()->row_array();
    	   	else
    	   		return $this->db->get()->result_array();
	    } else
	        return array();
	}
	
	public function db_error($return=FALSE)
	{
        $err_msg = $this->db->_error_message();
		$err_num = $this->db->_error_number();

        if ($return) {
		    return ($err_num > 0) ? json_encode(array('status' => 'error', 'message' => "Error ($err_num): $err_msg")) : '';
    	} else {
    		if ($err_num > 0) die(json_encode(array('status' => 'error', 'message' => "Error ($err_num): $err_msg")));
    	}
	}
}
?>
