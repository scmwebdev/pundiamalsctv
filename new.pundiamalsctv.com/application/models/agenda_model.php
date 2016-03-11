<?php  if (!defined('BASEPATH')) exit('tidak boleh masuk langsung');

class Agenda_model extends CI_Model {
		var $DB_READ 			= NULL;
		var $DB_WRITE           = NULL;
		var $db1;
		var $db2;
		var $tbl_category       = "tbl_category";
		var $tbl_news 	        = "tbl_news";
		var $tbl_penyumbang     = "tbl_gempa_aceh_bca";
		var $tbl_media			= "tbl_media";
		var $testimoni			= "testimoni";
		
	
    function __construct()
	{	
        parent::__construct();   
		
		$this->DB_READ  = $this->load->database('DB_READ', true);
        $this->DB_WRITE = $this->load->database('DB_WRITE', true);

		//$this->load->library('memcached_library');
    }
	
	function info_kegiatan()
	{
			
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
		SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
		FROM tbl_news a
		LEFT JOIN tbl_media c
		ON a.picid=c.id
		where  a.c_id IN (18,19) and publish='1'
        order by a.dates desc limit 0,5"	
    	);
		
		$data = $sql->result_array();
		return $data;
	}
	
	function detail_kesehatan()
	{
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title,
			tbl_news.shortdesc, 
			tbl_news.dates,
			tbl_news.c_id, 
			tbl_news.picid, 
			tbl_news.tpicid,
			tbl_news.sponsor_id,
			tbl_media.location,
			tbl_media.filename
			FROM tbl_news
			LEFT JOIN tbl_media ON tbl_news.picid = tbl_media.id
			WHERE tbl_news.c_id
			IN ( 23 ) AND tbl_news.sponsor_id=0
			ORDER BY tbl_news.id DESC
			LIMIT 0 , 4");
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_pendidikan()
	{
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title,
			tbl_news.shortdesc, 
			tbl_news.dates,
			tbl_news.c_id, 
			tbl_news.picid, 
			tbl_news.tpicid,
			tbl_news.sponsor_id,
			tbl_media.location,
			tbl_media.filename
			FROM tbl_news
			LEFT JOIN tbl_media ON tbl_news.picid = tbl_media.id
			WHERE tbl_news.c_id 
			IN ( 22 ) and tbl_news.sponsor_id=0
			ORDER BY tbl_news.id DESC
			LIMIT 0 , 4");
		
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_bencana()
	{
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title,
			tbl_news.shortdesc, 
			tbl_news.dates,
			tbl_news.c_id, 
			tbl_news.picid, 
			tbl_news.tpicid,
			tbl_news.sponsor_id,
			tbl_media.location,
			tbl_media.filename
			FROM tbl_news
			LEFT JOIN tbl_media ON tbl_news.picid = tbl_media.id
			WHERE tbl_news.c_id
			IN ( 24 )and tbl_news.sponsor_id=0
			ORDER BY tbl_news.id DESC
			LIMIT 0 , 4");
		
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_lingkungan()
	{
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title,
			tbl_news.shortdesc, 
			tbl_news.dates,
			tbl_news.c_id, 
			tbl_news.picid, 
			tbl_news.tpicid,
			tbl_news.sponsor_id,
			tbl_media.location,
			tbl_media.filename
			FROM tbl_news
			LEFT JOIN tbl_media ON tbl_news.picid = tbl_media.id
			WHERE tbl_news.c_id
			IN ( 25 )and tbl_news.sponsor_id=0
			ORDER BY tbl_news.id DESC
			LIMIT 0 , 4");
		
		$data = $sql->result_array();
		return $data;	

	}
	
	function berita()
	{
		$sql=$this->DB_WRITE->query("
			SELECT tbl_news.id, tbl_news.title,
			tbl_news.shortdesc, 
			tbl_news.dates,
			tbl_news.c_id, 
			tbl_news.picid, 
			tbl_news.tpicid,
			tbl_news.sponsor_id,
			tbl_media.location,
			tbl_media.filename
			FROM tbl_news
			LEFT JOIN tbl_media ON tbl_news.picid = tbl_media.id
			WHERE tbl_news.c_id
			IN ( 20,21 )and tbl_news.sponsor_id=0
			ORDER BY tbl_news.id DESC
			LIMIT 0 , 4");
		
		$data = $sql->result_array();
		return $data;	
	}
	
/*	function penyaluran_bantuan()
	{
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title,
			tbl_news.shortdesc, 
			tbl_news.dates,
			tbl_news.c_id, 
			tbl_news.picid, 
			tbl_news.tpicid,
			tbl_news.sponsor_id,
			tbl_media.location,
			tbl_media.filename
			FROM tbl_news
			LEFT JOIN tbl_media ON tbl_news.picid = tbl_media.id
			WHERE tbl_news.c_id
			IN ( 20 )
			ORDER BY tbl_news.id DESC
			LIMIT 0 , 4");
		
		$data = $sql->result_array();
		return $data;	
	}
	*/
	function foto()
	{
	 //	$sql = $this->DB_WRITE->query("SELECT id,location,caption FROM ".$this->tbl_media." where type = 'tpicID' order by id desc LIMIT 0,4");
	 	$sql= $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.vidid,a.sponsor_id,b.filename, b.location 
		FROM tbl_news a, tbl_media b  
		WHERE a.picID=b.id AND a.publish='1' 
		ORDER BY dates DESC LIMIT 0,4");
        $data = $sql->result_array();
		return $data;
	}
	
	function video()
	{
		
		$sql=$this->DB_WRITE->query("
		SELECT a.id,a.title,a.vidid,a.sponsor_id,b.filename, b.location 
		FROM tbl_news a, tbl_media b  
		WHERE a.vidID=b.id  AND a.publish='1' 
		ORDER BY a.id DESC LIMIT 0,4");
		
		$data = $sql->result_array();
		return $data;
		
	}
	
	function list_penyumbang()
	{	
	    $this->DB_READ = $this->load->database('DB_READ', true);
		
		$sql=$this->DB_READ->query("
		SELECT
		p_id, nourut, nama, jumlah, publish
		FROM tbl_gempa_aceh_bca
		WHERE publish='1' order by p_id desc limit 0,8				   
		");
		
		$data = $sql->result_array();
		//var_dump($data);
		//$data = array('test', '1', 'dua');
		
		return $data;
	}
	
	function testimoni()
	{	
		
		$sql=$this->DB_WRITE->query("SELECT 
		a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id , b.id
		FROM tbl_news a,tbl_category b 
		where a.c_id=b.id and b.id='28' and tbl_news.sponsor_id=0
        order by a.dates desc limit 0,4");
		
		$data = $sql->result_array();
		//var_dump($data);
		return $data;
	}
    
	
}