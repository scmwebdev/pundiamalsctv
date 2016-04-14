<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
    var $sess   = NULL;
    
    function __construct() {
        parent::__construct();
        $this->sess     = $this->session->userdata('kmk_member');
    }
    
	public function index()
	{
		$data['page_title']     = 'Welcome to OTT!';
		$data['sess']           = $this->sess;
		$data['sess_profile']   = $this->session->userdata('kmk_member_profile');
		
		$this->load->view('header', $data);
		$this->load->view('welcome_message', $data);
		$this->load->view('footer');
	}

	public function user()
	{
		$this->load->library('twconnect');
		$this->load->model('twitter_model');
		

		$this->twconnect->twaccount_verify_credentials();
		$xdata['userinfo'] = $this->twconnect->tw_user_info;

		// print_r($data['userinfo']);
		$data['name'] 		= $xdata['userinfo']->name;
		$data['lookup']		= $xdata['userinfo']->id;
		$data['password']	= $xdata['userinfo']->screen_name;
		$data['source']		= 'twitter';
		$data['id_profile']	= 0;

		//search credentials 
		$twitterCredential 	= $this->twitter_model->findByLookup($data); 
		if(count($twitterCredential) < 1){
			$this->twitter_model->addUser($data);
		}
		
		echo "welcome : ".$xdata['userinfo']->name;

		$this->load->view('header');
		$this->load->view('welcome_message');
		$this->load->view('footer');
		
	}
}