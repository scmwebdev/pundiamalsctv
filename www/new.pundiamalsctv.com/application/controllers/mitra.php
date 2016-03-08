<?php
 
class Mitra extends CI_Controller
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
		
		$data['terbaru']			=$this->homepage_model->terbaru();	
		$data['info_kegiatan']		=$this->homepage_model->info_kegiatan();
		$data['penyumbang']			=$this->homepage_model->list_penyumbang();
		$data['ticker']				=$this->homepage_model->ticker();
		$data['ticker_atas']		=$this->homepage_model->list_penyumbang();
		
		$jumlah						= $this->homepage_model->mitra_count();	
		$total 						= count($jumlah);

		$config['base_url'] 		= base_url().'index.php/mitra/index/';
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
		$data['mitra']				= $this->homepage_model->mitra($config['per_page'],$page);
		//$data['mitra']				= $this->db->query('mitra', $config['per_page'], $this->uri->segment(3));
		$data['links'] 				= $this->pagination->create_links();

		$this->load->view('mitra/header',$data);
		$this->load->view('mitra/mitra', $data);
		$this->load->view('mitra/footer',$data);
	
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
		$config['base_url'] 		= base_url().'index.php/mitra/search/';
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
		
		$this->load->view('mitra/header',$data);
		$this->load->view('mitra/search', $data);	
		$this->load->view('mitra/footer',$data);
	   
	}
	
	function view()
	{
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$id=$this->uri->segment(3);
		$data['ambilisi']	 	= $this->homepage_model->ambilisi($id);
		$sponsor=$data['ambilisi'][0]['sponsor_id'];
		//print_r($data['ambilisi'][0]['sponsor_id']);
		if($sponsor==1){
			$this->load->view('mitra/hsbc', $data);
		}elseif($sponsor==2){
			$this->load->view('mitra/xl', $data);
		}elseif($sponsor==3){
			$this->load->view('mitra/teleplan', $data);
		}else{
			$this->load->view('mitra/mandiri', $data);
		}
		
	/*	$this->load->view('mitra/header',$data);
		$this->load->view('mitra/read', $data);
		$this->load->view('mitra/footer',$data);*/
	}
}
	
	
	