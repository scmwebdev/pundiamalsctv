<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

  var $sess           = NULL;
  var $sess_profile   = NULL;

  function __construct()
  {
    parent::__construct();

    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');
  }

}