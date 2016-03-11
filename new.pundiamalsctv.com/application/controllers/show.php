<?php if (! defined('BASEPATH')) exit ('Akses langsung Tidak diperbolehkan');

class Show extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','text_helper','date'));
	}
	
	function headlines()
	{
		$his->load->model('galery_model');
		$data['headlines']=$his->galery_model->headlines();
		$this->load->view('home/header',$data);
		$this->load->view('agenda/header',$data);
		$this->load->view('profil/header',$data);
		$this->load->view('galeri/header',$data);
		$this->load->view('mitra/header',$data);
		$this->load->view('penyumbang/header',$data);
		$this->load->view('testimoni/header',$data);
		
	}
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function kalender_agenda()
	{
		 $this->load->model('homepage_model');	
		 $data['calender']		=$this->homepage_model->data_kalender();
		 $this->load->view('index',$data);
	}
	
	
}