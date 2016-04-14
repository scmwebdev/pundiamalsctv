<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {    
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->session->sess_destroy();

        echo '<script type="text/javascript">window.top.location.href="'.base_url().'";</script>';
    }
}