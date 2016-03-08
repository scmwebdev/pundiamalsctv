<?php if (! defined('BASEPATH')) exit ('Akses langsung Tidak diperbolehkan');

class Kalender extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','text_helper','date'));
	}
	
	
	function index()
	{
		$this->load->model('homepage_model');
		$data['events']=$this->homepage_model;
		$this->load->view('index',$data)
	}
}