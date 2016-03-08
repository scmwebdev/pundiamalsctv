<?php  if (!defined('BASEPATH')) exit('tidak boleh masuk langsung');
class Profil_model extends CI_Model {
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
	
	function list_terbaru()
	{
		$sql=$this->DB_WRITE->query("
		SELECT 
		id,title,shortdesc,dates,c_id,picid,tpicid,sponsor_id  
		FROM tbl_news  
		where publish='1' 
		and c_id IN (21,22,23,24,25) 
		ORDER BY dates 
		DESC limit 0,4");
		
		$cached_name ='18p_terbaru_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');}

	    	return $data;
		}
	}
	
	function info_kegiatan()
	{
		$sql=$this->DB_WRITE->query("SELECT id,title,shortdesc,dates,picid,tpicid  FROM ".$this->tbl_news."  WHERE  c_id = 18 and publish='1' 
		ORDER BY dates DESC LIMIT 0,2 ");
		
		$cached_name ='18p_infokegiatan_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');}

	    	return $data;
		}
		
	}
    
	function detail_info_kegiatan()
	{
		$sql=$this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.sponsor_id,b.name  
		FROM ".$this->tbl_news." a, ".$this->tbl_category." b  
		WHERE a.c_id=b.id and a.c_id = 18 and a.publish='1' 
		ORDER BY dates DESC");
		
		$data = $sql->result_array();
		return $data;
		
		/*$cached_name ='18p_detailinfokegiatan_pundiamal'.$this->tbl_news;
		$data		= $this->memcached_library->get($cached_name);
		
		if(!$data){ 
            $data = $sql->result_array();
            $this->memcached_library->set($cached_name,$data,240);
            // echo('Not cached');}

	    	return $data;
		}*/
	}
}