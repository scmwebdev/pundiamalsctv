<?php  if (!defined('BASEPATH')) exit('tidak boleh masuk langsung');
class Agenda_model extends CI_Model {
    function __construct() {
        parent::__construct();   
		
		var $DB_READ 			= NULL;
		var $DB_WRITE           = NULL;
		var $tbl_category       = "tbl_category";
		var $tbl_news 	        = "tbl_news";
		var $tbl_penyumbang     = "tbl_gempa_aceh_bca";
		var $tbl_media			= "tbl_media";
		var $testimoni			= "testimoni";
		var $tbl_penyumbang		= "tbl_gempa_aceh_bca";
	
    }
	
	function list_agenda()
	{
		$sql=$this->DB_WRITE->query("SELECT id,title,shortdesc,dates,picid,tpicid  FROM ".$this->tbl_news."  WHERE  c_id = 18 and publish='1' 
		ORDER BY dates DESC LIMIT 0,5 ");
		
		$cached_name ='18a_agenda_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');}

	    	return $data;
		}
	}
	
	function list_penyumbang()
	{
		$sql=$this->DB_READ->query("
		SELECT
		p_id, nourut, nama, jumlah, date_format( FROM_UNIXTIME( tanggal ) , '%d/%m/%Y' ) AS tanggal, publish
		FROM tbl_gempa_aceh_bca
		WHERE 1 order by p_id limit 0,7 desc				   
		");
		
		$cached_name ='18a_penyumbang_pundiamal'.$this->tbl_penyumbang;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }		
	}
	
	function detail_agenda()
	{
		$sql=$this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id = 18 and a.publish='1' 
		ORDER BY dates DESC");
		
		$cached_name ='18p_detailinfokegiatan_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');}

	    	return $data;
		}
	}
	
	function get_foto_terbaru(){
	 	$_sql = $this->DB_WRITE->query("SELECT id,location,caption FROM ".$this->tbl_media." where type = 'tpicID' order by id desc LIMIT 0,3");
		$cached_name = '18_03_90_fototerbaru_pundiamal'.$this->tbl_media;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }

    	return $data;
	}
	
	
	function get_list_foto(){
		$sql= $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_media." where type = 'tpicID' order by id desc");	

		$cached_name = '18_03_90_listfoto_pundiamal'.$this->tbl_media;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_video(){
		$sql =$this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.vidid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =26 and a.publish='1' 
		ORDER BY dates DESC");	
	
		$cached_name = '18_03_90_video_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_pendidikan(){
		$sql= $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =22 and a.publish='1' 
		ORDER BY dates DESC");	
		
		$cached_name = '18_03_90_pendidikan_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	
	function get_kesehatan(){
		$sql = $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =23 and a.publish='1' 
		ORDER BY dates DESC");	
	
		$cached_name = '18_03_90_kesehatan_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	 
	function get_bencana(){
		$sql = $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =24 and a.publish='1' 
		ORDER BY dates DESC");	
	
		$cached_name = '18_03_90_bencana_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}


	function get_lingkungan(){
		$sql =  $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =25 and a.publish='1' 
		ORDER BY dates DESC");	
		
		$cached_name = '18_03_90_lingkungan_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}


	function get_berita(){
		$sql = $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =21 and a.publish='1' 
		ORDER BY dates DESC");	
	
		$cached_name = '18_03_90_berita'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_penyaluran_bantuan(){
		$sql = $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id =20 and a.publish='1' 
		ORDER BY dates DESC");	
	
		$cached_name = '18_03_90_saluranbantuan_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }
	}
	
	function get_berita_terbaru($limit){
		$sql = $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.c_id,a.sponsor_id,a.vidid,b.name,b.dir  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.publish='1' 
		ORDER BY dates DESC limit 0,".$limit);	

		$cached_name = '18_03_90_beritaterbaru_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }		
	}
	
	
	function get_berita_terbaru_video($limit){
		$sql = $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.c_id,a.sponsor_id,a.vidid,b.name,b.dir  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.publish='1' and a.c_id='26' 
		ORDER BY dates DESC limit 0,".$limit);	

		$cached_name = '18_03_90_beritaterbaruvideo_pundiamal'.$this->tbl_news;
        $data        = $this->memcached_library->get($cached_name);
        // echo('cached');

        if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');
        }		
	}
	
	
}