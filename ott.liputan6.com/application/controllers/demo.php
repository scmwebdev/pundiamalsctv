<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller {
        
    function __construct() {
        parent::__construct();        
        $this->load->model('member_model');
    }
    
    function index() {
        //$this->session->sess_destroy();
        
		$sess       = $this->core_model->get_data(array('data'=>'row', 'table'=>'member_credentials', 'where'=>array('id_credential'=>4)));
		$profile    = $this->member_model->get_profile($sess['id_profile']);
		
        $sess['full_name']      = $profile['first_name'].' '.$profile['last_name'];
        $sess['email']          = $profile['email'];
        $sess['is_validate']    = $profile['is_validate'];
        
        $this->session->set_userdata('kmk_member', $sess);
        $this->session->set_userdata('kmk_member_profile', $profile);
        
        /*echo '<pre>';
        print_r($sess);
        print_r($profile);
        echo '</pre>';*/
        
        $this->load->model('campaign_model');
        $campaign = $this->campaign_model->get_default();

        redirect('campaign/'.$campaign[0]['slug'].'/buy');
    }
    
    var $limit = 10;
    
    function test_team($offset=0) {
		$this->load->model('team_model');
		$q = $this->team_model->get_all($this->limit,$offset);
		print_r($q);
	}
    
}
