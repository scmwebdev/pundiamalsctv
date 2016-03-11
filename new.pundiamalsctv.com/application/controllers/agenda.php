<?php

class Agenda extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','text_helper','date'));
	}
	
	function index()
	{
		$this->load->model(array('homepage_model','galery_model','agenda_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$data['terbaru']		=$this->homepage_model->terbaru();	
		$data['penyumbang']		=$this->agenda_model->list_penyumbang();
		$data['info_kegiatan']  =$this->agenda_model->info_kegiatan();
		$data['testimoni']  	=$this->homepage_model->testimoni();
		$data['kesehatan']		=$this->agenda_model->detail_kesehatan();
		$data['lingkungan']		=$this->agenda_model->detail_lingkungan();
		$data['bencana']		=$this->agenda_model->detail_bencana();
		$data['pendidikan']		=$this->agenda_model->detail_pendidikan();
		$data['berita']			=$this->agenda_model->berita();
		//$data['foto']			=$this->agenda_model->foto();
		$data['foto']			=$this->homepage_model->get_foto_terbaru();
		//$data['video']			=$this->agenda_model->video();
		$data['video']			=$this->homepage_model->video();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['calender']		=$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/agenda_berita', $data);
		$this->load->view('agenda/footer',$data);
	}
	
	

	function view()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['baca_juga']		=$this->homepage_model->artikel_terkait($id);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ambilisi'] 		= $this->homepage_model->ambilisi($id);
		$data['calender']		=$this->homepage_model->data_kalender();
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/read', $data);
		$this->load->view('agenda/footer',$data);
	}
	
	function index_kesehatan()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->kesehatan();	
		$total = count($jumlah);
		$data['headlines']			=$this->galery_model->headlines();
		$config['base_url'] 		= base_url().'index.php/agenda/index_kesehatan/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_pilar_kesehatan']= $this->homepage_model->detail_kesehatan($config['per_page'],$page);
		//$data['mitra']				= $this->db->query('mitra', $config['per_page'], $this->uri->segment(3));		
		$data['ticker']				=$this->homepage_model->ticker();
		$data['ticker_atas']		=$this->homepage_model->list_penyumbang();
		$data['terbaru']			=$this->homepage_model->terbaru();	
		$data['pilar']				=$this->homepage_model->list_pilar_pa();
		$data['penyumbang']			=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  	=$this->homepage_model->info_kegiatan();
		$data['calender']			=$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_kesehatan', $data);	
		$this->load->view('agenda/footer',$data);
	}
	
	function index_pendidikan()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->pendidikan();	
		$total = count($jumlah);
		
		//$id=$this->uri->segment(3);
		$data['headlines']			=$this->galery_model->headlines();
		$config['base_url'] 		= base_url().'index.php/agenda/index_pendidikan/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_pilar_pendidikan']= $this->homepage_model->detail_pendidikan($config['per_page'],$page);
		//var_dump($config['per_page']) or die();
		$data['terbaru']		=$this->homepage_model->terbaru();	
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['pilar']			=$this->homepage_model->list_pilar_pa();
		$data['calender']		=$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_pendidikan', $data);	
		$this->load->view('agenda/footer',$data);
	}
	
	function index_bencana()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->bencana();	
		$total = count($jumlah);
		$data['headlines']			=$this->galery_model->headlines();
		$config['base_url'] 		= base_url().'index.php/agenda/index_bencana/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 						  = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_pilar_bencana'] = $this->homepage_model->detail_bencana($config['per_page'],$page);
		$data['terbaru']			  = $this->homepage_model->terbaru();	
		$data['penyumbang']		      = $this->homepage_model->list_penyumbang();
		$data['info_kegiatan']        = $this->homepage_model->info_kegiatan();
		$data['ticker']			      = $this->homepage_model->ticker();
		$data['ticker_atas']		  =$this->homepage_model->list_penyumbang();
		$data['pilar']			      = $this->homepage_model->list_pilar_pa();
		$data['calender']			  =	$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_bencana', $data);	
		$this->load->view('agenda/footer',$data);
	}
	
	function index_bantuan()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->bantuan();	
		$total = count($jumlah);
		$data['headlines']			=$this->galery_model->headlines();
		$config['base_url'] 		= base_url().'index.php/agenda/index_bantuan/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 						  = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_pilar_bantuan'] = $this->homepage_model->detail_bantuan($config['per_page'],$page);
		$data['terbaru']			  = $this->homepage_model->terbaru();	
		$data['penyumbang']		      = $this->homepage_model->list_penyumbang();
		$data['info_kegiatan']        = $this->homepage_model->info_kegiatan();
		$data['ticker_atas']		  =$this->homepage_model->list_penyumbang();
		$data['ticker']			      = $this->homepage_model->ticker();
		$data['pilar']			      = $this->homepage_model->list_pilar_pa();
		$data['calender']			  = $this->homepage_model->data_kalender();
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_penyaluranbantuan', $data);	
		$this->load->view('agenda/footer',$data);
	}
	
	
	function index_berita()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->berita();	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/agenda/index_berita/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 				    =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_berita']  = $this->homepage_model->detail_berita($config['per_page'],$page);
		$data['headlines']		=$this->galery_model->headlines();
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['testimoni']  	=$this->homepage_model->testimoni();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['foto']			=$this->homepage_model->get_foto_terbaru();
		$data['video']			=$this->homepage_model->video();
		$data['pilar']			=$this->homepage_model->list_pilar_pa();
		$data['calender']		=$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_berita', $data);	
		$this->load->view('agenda/footer',$data);
			
	}
	
	function index_terbaru()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->berita_terbaru();	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/agenda/index_terbaru/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 				    =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_terbaru'] = $this->homepage_model->detail_terbaru($config['per_page'],$page);	
		$data['headlines']		=$this->galery_model->headlines();
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['testimoni']  	=$this->homepage_model->testimoni();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['foto']			=$this->homepage_model->get_foto_terbaru();
		$data['video']			=$this->homepage_model->video();
		$data['pilar']			=$this->homepage_model->list_pilar_pa();
		$data['calender']		=$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_terbaru', $data);	
		$this->load->view('agenda/footer',$data);
		
	}
	
	function info_kegiatan()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$jumlah=$this->homepage_model->berita_terbaru();	
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->count_infokegiatan();	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/agenda/info_kegiatan/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 						  = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_infokegiatan']  = $this->homepage_model->detail_infokegiatan($config['per_page'],$page);
		//$this->load->library('pagination');
		$data['headlines']		=$this->galery_model->headlines();
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['testimoni']  	=$this->homepage_model->testimoni();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['calender']		=$this->homepage_model->data_kalender();
		$data['foto']			=$this->homepage_model->get_foto_terbaru();
		$data['video']			=$this->homepage_model->video();
		$data['pilar']			=$this->homepage_model->list_pilar_pa();
		
		
			
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/info_kegiatan', $data);	
		$this->load->view('agenda/footer',$data);
	}
	
	function index_lingkungan()
	{
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
		$jumlah=$this->homepage_model->lingkungan();	
		$total = count($jumlah);
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/agenda/info_lingkungan/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 20;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		
		$this->pagination->initialize($config);
		$page 						  	 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['detail_pilar_lingkungan'] = $this->homepage_model->detail_lingkungan($config['per_page'],$page);
		$data['terbaru']				 = $this->homepage_model->terbaru();	
		$data['headlines']				 = $this->galery_model->headlines();
		$data['penyumbang']				 = $this->homepage_model->list_penyumbang();
		$data['ticker_atas']			 =$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  		 = $this->homepage_model->info_kegiatan();
		$data['headlines']				 =$this->galery_model->headlines();
		$data['ticker']					 = $this->homepage_model->ticker();
		$data['pilar']					 = $this->homepage_model->list_pilar_pa();
		$data['calender']				 = $this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/index_lingkungan', $data);	
		$this->load->view('agenda/footer',$data);
	}
	
	function search()
	{
	   $this->load->model(array('homepage_model','galery_model'));
	   $this->load->library('pagination');
	   $data['keyword'] = trim($this->input->get('search'));
	 //  print_r($keyword);
		$jumlah=$this->homepage_model->count_search($data['keyword']);	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/agenda/search/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 7;
		$config['num_links'] 		= 10;
		
		$config['num_tag_open'] 	= '<li style=border-bottom:none>';
		$config['num_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li style=border-bottom:none>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li style=border-bottom:none>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li style=border-bottom:none><strong><span>';
		$config['cur_tag_close'] 	= '</span></strong></li>';
		$config['last_tag_open'] 	= '<li style=border-bottom:none>';
		$config['last_tag_close'] 	= '</li>';
		$config['first_tag_open'] 	= '<li style=border-bottom:none>';
		$config['first_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		$page 				    =($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['search']  		= $this->homepage_model->search($data['keyword'],$config['per_page'],$page);	
		$data['headlines']		=$this->galery_model->headlines();
		//print_r($data['search']);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['calender']		=$this->homepage_model->data_kalender();
		
		$this->load->view('agenda/header',$data);
		$this->load->view('agenda/search', $data);	
		$this->load->view('agenda/footer',$data);
	   
	}
	
	
}