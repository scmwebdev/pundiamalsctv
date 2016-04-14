<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
  var $sess   = NULL;

  function __construct() {
    parent::__construct();
    $this->sess     = $this->session->userdata('kmk_member');
  }

  function index() {
    if (!empty($this->sess) && $this->sess['id_profile'] == '0') redirect('register');
    if (!empty($this->sess) && $this->sess['id_profile'] != '0') redirect();

    $data['page_title']     = 'Login';
		$data['sess']           = $this->sess;

		//$this->load->view('header', $data);
		//$this->load->view('login_index', $data);
		//$this->load->view('footer');

    $data['page'] = 'login';
    $this->load->view('v2/template', $data);
  }
}
