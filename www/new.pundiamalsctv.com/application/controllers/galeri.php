<?php if (! defined('BASEPATH')) exit ('Akses langsung Tidak diperbolehkan');

class Galeri extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','text_helper','date'));
	}
	
	
	function view()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$id=$this->uri->segment(3);
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['baca_juga']		=$this->homepage_model->artikel_terkait($id);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ambilisi'] 	= $this->homepage_model->ambilisi($id);
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/read', $data);
		$this->load->view('galeri/footer',$data);
	}
	
	function readvideo()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$id=$this->uri->segment(3);
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['baca_juga']		=$this->homepage_model->artikel_terkait($id);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ambilvideo'] 		= $this->homepage_model->ambilvideo($id);
		
		//$this->load->view('galeri/header',$data);
		$this->load->view('galeri/readvideo', $data);
		$this->load->view('galeri/footer',$data);
	
	}
	
	function view_video()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$id=$this->uri->segment(3);
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ambilvideo'] 	= $this->homepage_model->ambilvideo($id);
		$data['video']			=$this->homepage_model->video();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['video_lainnya']	= $this->galery_model->video_lainnya();
		$data['left_terbaru']	=$this->homepage_model->terbaru();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/galerivideo_detail', $data);
		$this->load->view('galeri/footer',$data);
	}
	
	function galery_foto()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$this->load->library('pagination');
		$id=$this->uri->segment(3);
		
		$jumlah=$this->galery_model->count_foto();	
		$total = count($jumlah);
		
		$config['base_url'] 		= base_url().'index.php/galeri/galery_foto/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 40;
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
		$data['foto']= $this->galery_model->galery_foto($config['per_page'],$page);
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['foto_lainnya']	=$this->galery_model->foto();
		$data['terbaru']		=$this->homepage_model->terbaru();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/galeri_foto', $data);
		$this->load->view('galeri/footer',$data);
		
	}
	
	function galery_video()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$this->load->library('pagination');
		$id=$this->uri->segment(3);
		
		$jumlah=$this->galery_model->count_video();	
		$total = count($jumlah);
		//print_r($total);
		
		$config['base_url'] 		= base_url().'index.php/galeri/galery_video/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 40;
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
		$page 					= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['video']			= $this->galery_model->galery_video($config['per_page'],$page);
		$data['info_kegiatan']  = $this->homepage_model->info_kegiatan();
		$data['penyumbang']		= $this->homepage_model->list_penyumbang();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			= $this->homepage_model->ticker();
		$data['terbaru']		= $this->homepage_model->terbaru();
		
		//$this->load->view('galeri/header',$data);
		$this->load->view('galeri/galeri_video', $data);
		$this->load->view('galeri/footer',$data);
		
	}
	
	function view_foto()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$id=$this->uri->segment(3);
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ambilfoto']   = $this->homepage_model->ambilfoto($id);
		$data['ticker']		 =$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['foto_lainnya']=$this->galery_model->foto_lainnya($id);
		//print_r($data['foto_lainnya']);
		$data['terbaru']	=$this->homepage_model->terbaru();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/galerifoto_detail', $data);
		$this->load->view('galeri/footer',$data);
		
	}
	
	function index()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		//$this->load->library('pagination');
		$data['foto']				=$this->galery_model->foto();	
		$data['video']				=$this->galery_model->video();	
		$data['terbaru']			=$this->galery_model->terbaru();	
		$data['info_kegiatan']		=$this->galery_model->info_kegiatan();	
		$data['penyumbang']			=$this->homepage_model->list_penyumbang();
		$data['ticker']				=$this->homepage_model->ticker();
		$data['ticker_atas']		=$this->homepage_model->list_penyumbang();
		$data['calender']			=$this->homepage_model->data_kalender();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/galeri', $data);
		$this->load->view('galeri/footer',$data);
	}
	
	
	function foto()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		//$this->load->library('pagination');
		$data['foto']				=$this->galery_model->foto();	
		$data['terbaru']			=$this->galery_model->terbaru();	
		$data['info_kegiatan']		=$this->galery_model->info_kegiatan();	
		$data['penyumbang']			=$this->homepage_model->list_penyumbang();
		$data['ticker']				=$this->homepage_model->ticker();
		$data['ticker_atas']		=$this->homepage_model->list_penyumbang();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/galerifoto_detail', $data);
		$this->load->view('galeri/footer',$data);
		
	}
	
	function search_gallery()
	{
	   $this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
	   $this->load->library('pagination');
	   $data['keyword'] = trim($this->input->get('search'));
	   
	 //  print_r($keyword);
		$jumlah=$this->homepage_model->count_searchfoto($data['keyword']);	
		$total = count($jumlah);
		if($total>0){
		$config['base_url'] 		= base_url().'index.php/galeri/search_gallery/';
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
		$data['search']  		= $this->homepage_model->search_foto($data['keyword'],$config['per_page'],$page);	
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker']			=$this->homepage_model->ticker();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/search_foto', $data);	
		$this->load->view('galeri/footer',$data);
		}else{
		$jumlah=$this->galery_model->count_searchvideo($data['keyword']);	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/galeri/search_gallery/';
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
		$data['search']  		= $this->galery_model->search_video($data['keyword'],$config['per_page'],$page);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker']			=$this->homepage_model->ticker();
		
		$this->load->view('galeri/header',$data);
		$this->load->view('galeri/searchvideo', $data);	
		$this->load->view('galeri/footer',$data);	
		}
		//print_r($data['search']);
		
	
	}
	
	/*function search_video()
	{
		
		$this->load->model(array('homepage_model','galery_model'));
		$this->load->library('pagination');
	    $keyword = $this->input->get('search');
		
		$jumlah=$this->galery_model->count_searchvideo($keyword);	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/galeri/search_video/';
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
		$data['search']  		= $this->galery_model->search_video($keyword,$config['per_page'],$page);	
		//print_r($data['search']);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		
		//$this->load->view('galeri/header',$data);
		
	}*/
						  
	
}
	
	
	