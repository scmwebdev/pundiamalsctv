<?php
class Penyumbang extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','text_helper','date'));
	}
	
	function index()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$this->load->library('pagination');	
		$data['terbaru']			=$this->galery_model->terbaru();	
		$data['info_kegiatan']		=$this->galery_model->info_kegiatan();	
		
		$jumlah=$this->homepage_model->count_penyumbang();	
		$total = count($jumlah);
		//print_r($total);
		$config['base_url'] 		= base_url().'index.php/penyumbang/index/';
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 16;
		$config['num_links'] 		= 4;
		
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
		$page 						  = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['penyumbang']		  	  = $this->homepage_model->penyumbang($config['per_page'],$page);
		$data['page']				  = $page;
		$data['ticker']				  = $this->homepage_model->ticker();
		$data['ticker_atas']		  = $this->homepage_model->list_penyumbang();
		
		$this->load->view('penyumbang/header',$data);
		$this->load->view('penyumbang/daftar_penyumbang', $data);	
		$this->load->view('penyumbang/footer',$data);
	}
	
	function search()
	{
	   $this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
	   $this->load->library('pagination');
	   $data['keyword'] = trim($this->input->get('search'));
	 //  print_r($keyword);
		$jumlah=$this->homepage_model->count_search($data['keyword']);	
		$total = count($jumlah);
		$config['base_url'] 		= base_url().'index.php/penyumbang/search/';
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
		//print_r($data['search']);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		
		$this->load->view('penyumbang/header',$data);
		$this->load->view('penyumbang/search', $data);	
		$this->load->view('penyumbang/footer',$data);
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
		
		$this->load->view('penyumbang/header',$data);
		$this->load->view('penyumbang/read', $data);	
		$this->load->view('penyumbang/footer',$data);
	}
	
	function cari_penyumbang()
	{
	   $this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
	   $this->load->library('pagination');
	   $data['keyword'] = $this->input->get('keysearch');
	   $data['kategori']=$this->input->get('fldsearch');
	   
	   $keyword=$data['keyword'];
	   $kategori= $data['kategori'];
	
		if($kategori=='nama'){
		$jumlah=$this->homepage_model->count_carinamapenyumbang($keyword);
		}elseif($kategori=='kota'){
		$jumlah=$this->homepage_model->count_carikotapenyumbang($keyword);
		}else{
		$jumlah=$this->homepage_model->count_caritanggalpenyumbang($keyword);}
		$total = count($jumlah);
		//print_r($total);
		$config['base_url'] 		= base_url().'index.php/penyumbang/cari_penyumbang/';
		//print_r($config['base_url']);
		$config['total_rows'] 		= $total;
		$config['per_page'] 		= 16;
		$config['num_links'] 		= 4;
		
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
		$page 				    	=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($data['kategori']){
		$data['datapenyumbang']     = $this->homepage_model->cari_namapenyumbang($keyword,$config['per_page'],$page);	
		}elseif($data['kategori']){
		$data['datapenyumbang']     = $this->homepage_model->cari_kotapenyumbang($keyword,$config['per_page'],$page);	
		}else{
		$data['datapenyumbang']     = $this->homepage_model->cari_tanggalpenyumbang($keyword,$config['per_page'],$page);	
		}
		//print_r($data['data_penyumbang']);
		$data['page']		    =$page;
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		
		$this->load->view('penyumbang/header',$data);
		$this->load->view('penyumbang/data_penyumbang', $data);	
		$this->load->view('penyumbang/footer',$data);
	
	}
}