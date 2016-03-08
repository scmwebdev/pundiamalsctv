<?php if (! defined('BASEPATH')) exit ('Akses langsung Tidak diperbolehkan');

class Home extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','text_helper','date'));
	}
	
	
	function index()
	{
		//pilar
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$data['pilar']	    	=$this->homepage_model->list_pilar_pa();	
		$data['headline'] 		=$this->homepage_model->get_headline();
		$data['terbaru']		=$this->homepage_model->list_terbaru();
		$data['sebelumnya']		=$this->homepage_model->list_sebelumnya();
		$data['testimoni']		=$this->homepage_model->testimoni();
		//print_r($data['testimoni']);
		$data['video']			=$this->homepage_model->video();
		//$data['detail_video']=$this->homepage_model->video_detail($v['title']);
		//print_r($data['video']);
		$data['foto']			=$this->homepage_model->get_foto_terbaru();
		$data['penyumbang']		=$this->homepage_model->list_penyumbang();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['calender']		=$this->homepage_model->data_kalender();
		
		//print_r($data['calender']);
		$this->load->view('home/header',$data);
		$this->load->view('home/index', $data);	
		$this->load->view('home/footer',$data);
	}
	
	function headlines()
	{
		
		$this->load->view('home/header',$data);	
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
		$config['base_url'] 		= base_url().'index.php/home/search/';
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
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		
		$this->load->view('home/header',$data);
		$this->load->view('home/search', $data);	
		$this->load->view('home/footer',$data);
	   
	}
	
	function view()
	{
		require 'facebook/facebook.php';
		$this->load->model(array('homepage_model','galery_model'));
		
		//$id=$this->uri->segment(3);
		$data['headlines']		=$this->galery_model->headlines();
		$this->load->library('facebook');
		$id=$this->uri->segment(3);
		
		$data['info_kegiatan']  =$this->homepage_model->info_kegiatan();
		$data['baca_juga']		=$this->homepage_model->artikel_terkait($id);
		$data['terbaru']		=$this->homepage_model->terbaru();
		$data['ticker_atas']	=$this->homepage_model->list_penyumbang();
		$data['ticker']			=$this->homepage_model->ticker();
		$data['ambilisi'] 		= $this->homepage_model->ambilisi($id);

			$facebook = new Facebook(array(
			  'appId' => '645664388788940',
			  'secret' =>'35d22d28ceb4c5d97c5eefe6b9ee8b1e',
			));

			// See if there is a user from a cookie
			$user = $facebook->getUser();

			if ($user) {
			  try {
				// Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $facebook->api('/me');
			  } catch (FacebookApiException $e) {
				echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
				$user = null;
			  }
			}
		
		$opengraph = array(
			'type'	=> 'website',
			'title'	=> $data['ambilisi'][0]['title'],
			'url'	=> site_url(),
			'image'	=> $data['ambilisi'][0]['location'],
			'description'	=> $data['ambilisi'][0]['shortdesc']
		);

		$this->load->vars('opengraph', $opengraph);
		$this->load->view('home/header',$data);
		$this->load->view('agenda/read', $data);
		$this->load->view('home/footer',$data);
	}
}