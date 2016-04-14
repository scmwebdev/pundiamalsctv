<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    var $sess   = NULL;
    
    function __construct() {
        parent::__construct();
        $this->sess     = $this->session->userdata('kmk_member');
        $this->load->model('member_model');
    }
    
    function index() {
        $data['page_title']     = 'Registration';
		$data['sess']           = $this->sess;
		$data['sess_profile']   = $this->session->userdata('kmk_member_profile');
		$data['mst_propinsi']   = $this->core_model->get_data(array('table'=>'mst_propinsi', 'order_by'=>'nama_propinsi asc'));
		$data['mst_teams']      = $this->core_model->get_data(array('table'=>'teams', 'order_by'=>'team_name asc'));
		
		$this->load->view('header', $data);
		$this->load->view('register_index', $data);
		$this->load->view('footer');
    }
    
	public function get_kabupaten_kota()
	{
	    if (isset($_POST['id'])) {
            $kota       = $this->member_model->get_kabupaten_kota($_POST['id']);
	        $txt        = '';
			$id_kab_kota= (isset($_POST['id_kota']))? $_POST['id_kota'] : '';
			
	        foreach($kota as $row) {
				$selected = ($row['id_kabupaten_kota'] == $id_kab_kota) ? 'selected="selected"' : '';
				$txt .= '<option '.$selected.' value="'.$row['id_kabupaten_kota'].'">'.$row['nama_kabupaten_kota'].'</option>';
			}
			
	        echo $txt;
	    }
	}
	
	function submit()
	{
		if (isset($_POST['email'])) $this->member_model->insert_profile($_POST);
	}
}