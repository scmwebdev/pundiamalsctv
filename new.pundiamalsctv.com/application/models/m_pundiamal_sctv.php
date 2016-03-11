<?php if ( ! defined('BASEPATH')) exit('Akses tidak boleh langsung');

class M_pundiamal_sctv extends CI_Model {

	var $DB_READ 			= NULL;
    var $DB_WRITE           = NULL;
	var $tbl_category       = "tbl_category";
    var $tbl_news 	        = "tbl_news";
	var $tbl_penyumbang     = "tbl_gempa_aceh_bca";
	var $tbl_media			= "tbl_media";
	var $tbl_penyumbang		= "tbl_gempa_aceh_bca";
	
	
	function __construct() 
	{
        parent::__construct();
        //$this->DB_READ->get();
        $this->DB_READ  = $this->load->database('db_pundiamal_read', true);
        $this->DB_WRITE = $this->load->database('db_pundiamal_write', true);
		$this->load->library('memcached_library');
    }
	
	function get_pilar()
	{
		$sql = $this->DB_WRITE->query("
		SELECT id,name,shortdesc,dates,picid,tpicid,sponsor_id FROM ".$this->tbl_category."  WHERE  pilar = '1' 	
    	");
		
        $cached_name = '18_03_90_rheda_pundiamal'.$this->tbl_category;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }

    	return $data;
	}
	
	function get_news_pilar_terbaru()
	{
		$sql=$this->DB_WRITE->query("
		SELECT 
		id,title,shortdesc,dates,c_id,picid,tpicid,sponsor_id  
		FROM tbl_news  
		where publish='1' 
		and c_id IN (22,23,24,25) 
		ORDER BY dates 
		DESC limit 0,4");
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_all_pilar_news()
	{
		$sql=$this->DB_WRITE->query("SELECT 
		id,title,shortdesc,dates,c_id,picid,tpicid,sponsor_id  
		FROM tbl_news  
		where publish='1' 
		and c_id IN (22,23,24,25) 
		ORDER BY dates 
		DESC limit 5,10"	
		);
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_foto_terbaru()
	{
		$ql=$this->DB_WRITE->query("
		SELECT id,filename,location,caption FROM ".$this->tbl_media." where type = 'tpicID' order by id desc limit 0,4					  
		");
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_media;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_all_foto()
	{
		$sql=$this->DB_WRITE->query("
		SELECT id,filename,location,caption FROM ".$this->tbl_media." where type = 'tpicID' order by id desc				   
		");
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_media;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
		
	}
	
	function get_all_data_penyumbang()
	{	
		$sql=$this->DB_READ->query("
		SELECT
		p_id, nourut, nama, jumlah, date_format( FROM_UNIXTIME( tanggal ) , '%d/%m/%Y' ) AS tanggal, publish
		FROM tbl_gempa_aceh_bca
		WHERE 1 order by p_id desc				   
		");
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_penyumbang;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }	
	}
	
	function info_kegiatan()
	{
		$sql=$this->DB_WRITE->query("
		SELECT id,name,shortdesc,dates,picid,tpicid,sponsor_id FROM ".$this->tbl_category."  WHERE  id=18"
		);
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }	
	}
	
	function get_all_news()
	{
		$sql=$this->DB_WRITE->query("SELECT id,title,shortdesc,dates,picid,tpicid,sponsor_id  FROM ".$this->tbl_category."  WHERE  c_id = 21 and publish='1' 
		ORDER BY dates DESC");
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }	
		
	}
	
	function get_news()
	{
		$sql=$this->DB_WRITE->query("SELECT id,title,shortdesc,dates,picid,tpicid,sponsor_id  FROM ".$this->tbl_category."  WHERE  c_id = 21 and publish='1' 
		ORDER BY dates DESC");
		
		$cached_name ='18-03-90_rheda_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }		
	}
	
}