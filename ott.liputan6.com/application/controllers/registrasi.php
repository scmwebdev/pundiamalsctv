<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registrasi extends CI_Controller {
    var $sess   = NULL;
    
    function __construct() {
        parent::__construct();
        $this->sess     = $this->session->userdata('kmk_member');
    }

    public function index()
    {
		$hdata = $cdata = $fdata = $ndata = array();
   		$hdata['page_title']    = 'Registrasi';
   		$ndata['link_active']	= 'registrasi';

		//template data
        $data['header'] 	= $this->load->view('ott/header', $hdata, TRUE);
        $data['nav'] 		= $this->load->view('ott/nav', $ndata, TRUE);
        $data['content'] 	= $this->load->view('registrasi/index', $cdata, TRUE);
        $data['footer'] 	= $this->load->view('ott/footer', $fdata, TRUE);
		$this->load->view('ott/template', $data);
    }


}