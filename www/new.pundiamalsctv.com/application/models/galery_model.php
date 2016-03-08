<?php  if (!defined('BASEPATH')) exit('tidak boleh masuk langsung');

class Galery_model extends CI_Model {
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
	function headlines()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT id,filename, location, caption FROM tbl_media WHERE type='bfpicID' order by id desc limit 0,4");
		$data = $sql->result_array();
		return $data;	
	}
	function galery_foto($limit,$start)
	{
		/*$sql= $this->DB_WRITE->query("SELECT a.id,a.title,a.news,a.shortdesc,a.dates,a.c_id,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.tpicid=c.id
				WHERE a.publish='1' ORDER BY a.dates limit ".$start." ,".$limit."");*/
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql= $this->DB_WRITE->query("SELECT a.id, 
									 		 a.title,
											 a.description,
											 a.publish, 
											 a.dates,
											 b.filename,
											 b.location, 
											 b.caption, 
											 b.id_gallery
							FROM tbl_gallery a
							LEFT JOIN tbl_media b ON a.id = b.id_gallery GROUP BY a.title ORDER BY a.dates desc limit ".$start." ,".$limit."");
        $data = $sql->result_array();
		return $data;	
		
	}
	
	function count_foto()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql= $this->DB_WRITE->query("SELECT a.id, 
									 		 a.title,
											 a.description,
											 a.publish, 
											 a.dates,
											 b.filename,
											 b.location, 
											 b.caption, 
											 b.id_gallery
							FROM tbl_gallery a
							LEFT JOIN tbl_media b ON a.id = b.id_gallery GROUP BY a.title ORDER BY a.dates desc");
        $data = $sql->result_array();
		return $data;	
	}
	
	function galery_video($limit,$start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql= $this->DB_WRITE->query("SELECT 
			a.`id`,
			a.`title`,
			a.`news`,
			a.`c_id`,
			a.`dates`,
			a.`headline`,
			a.`publish`,
			b.`filename` AS 'name_pic',
			b.`location` as 'loc_pic',
			c.`filename` AS 'name_tpic',
			c.`location` as 'loc_tpic',
			d.`filename` AS 'name_vic',
			d.`location` as 'loc_vic'
			FROM `tbl_news` a
			LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
			LEFT JOIN `tbl_media` c ON a.`tpicID`= c.`id`
			LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
			where  a.c_id='26'
			group by(a.`id`) order by a.`dates` DESC limit ".$start." ,".$limit."");
		
        $data = $sql->result_array();
		return $data;	
	}
	
	function count_video()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql= $this->DB_WRITE->query("SELECT 
			a.`id`,
			a.`title`,
			a.`news`,
			a.`c_id`,
			a.`dates`,
			a.`headline`,
			a.`publish`,
			b.`filename` AS 'name_pic',
			b.`location` as 'loc_pic',
			c.`filename` AS 'name_tpic',
			c.`location` as 'loc_tpic',
			d.`filename` AS 'name_vic',
			d.`location` as 'loc_vic'
			FROM `tbl_news` a
			LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
			LEFT JOIN `tbl_media` c ON a.`tpicID`= c.`id`
			LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
			where  a.c_id='26'
			group by(a.`id`) order by a.`id` DESC");
        $data = $sql->result_array();
		return $data;	
	}
	
	function foto()
	{
		/*$sql= $this->DB_WRITE->query("SELECT a.id, a.title, a.shortdesc, a.dates, a.tpicID, a.sponsor_id, b.filename, b.location
			FROM tbl_news a, tbl_media b
			WHERE a.tpicID = b.id
			AND a.publish = '1'
			ORDER BY dates DESC limit 0,12");*/
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql= $this->DB_WRITE->query("SELECT a.id, 
									 		 a.title,
											 a.description,
											 a.publish, 
											 a.dates,
											 b.filename,
											 b.location, 
											 b.caption, 
											 b.id_gallery
							FROM tbl_gallery a
							LEFT JOIN tbl_media b ON a.id = b.id_gallery  GROUP BY a.title ORDER BY a.dates DESC limit 0,12");
        $data = $sql->result_array();
		return $data;		
	}
	
	function foto_lainnya($id)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT a.id, 
									 		 a.title,
											 a.description,
											 a.publish, 
											 a.dates,
											 b.filename,
											 b.location, 
											 b.caption, 
											 b.id_gallery
							FROM tbl_gallery a
							LEFT JOIN tbl_media b ON a.id = b.id_gallery WHERE a.id=".$id."");
		$data = $sql->result_array();
		return $data;	
		
	}
	
	function video_lainnya()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT 
									a.`id`,
									a.`title`,
									a.`news`,
									a.`c_id`,
									a.`dates`,
									a.`headline`,
									a.`publish`,
									b.`filename` AS 'name_pic',
									b.`location` as 'loc_pic',
									c.`filename` AS 'name_tpic',
									c.`location` as 'loc_tpic',
									d.`filename` AS 'name_vic',
									d.`location` as 'loc_vic'
									FROM `tbl_news` a
									LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
									LEFT JOIN `tbl_media` c ON a.`tpicID`= c.`id`
									LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
									where  a.c_id='26'
									group by(a.`id`) order by a.`id` DESC");
		
		$data = $sql->result_array();
		return $data;	
		
	}
	
	
	function video()
	{
		/*$sql= $this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.picid,a.tpicid,a.vidid,a.sponsor_id,b.filename, b.location 
		FROM tbl_news a, tbl_media b  
		WHERE a.vidID=b.id AND a.publish='1' 
		ORDER BY dates DESC limit 0,12");*/
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT 
									a.`id`,
									a.`title`,
									a.`news`,
									a.`c_id`,
									a.`dates`,
									a.`headline`,
									a.`publish`,
									b.`filename` AS 'name_pic',
									b.`location` as 'loc_pic',
									c.`filename` AS 'name_tpic',
									c.`location` as 'loc_tpic',
									d.`filename` AS 'name_vic',
									d.`location` as 'loc_vic'
									FROM `tbl_news` a
									LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
									LEFT JOIN `tbl_media` c ON a.`tpicID`= c.`id`
									LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
									where  a.c_id='26'
									group by(a.`id`) order by a.`id` DESC limit 0,12");
        $data = $sql->result_array();
		return $data;	
	}
	
	
	function terbaru()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT 
		a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,b.name, b.picID, c.location, c.filename
		FROM tbl_news a,tbl_category b ,tbl_media c
		where a.c_id=b.id and c.id=b.picID and publish='1' 
		and a.c_id IN (20,21,22,23,24,25) 
        order by a.dates desc limit 0,3");
		
		$data = $sql->result_array();
		return $data;
	}
	
	function info_kegiatan()
	{
			
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
		SELECT 
		a.id,a.title,a.dates,a.c_id,b.name 
		FROM tbl_news a,tbl_category b  
		where a.c_id=b.id and publish='1' 
		and a.c_id IN (18) 
        order by a.dates desc limit 0,5"	
    	);
		
		$data = $sql->result_array();
		return $data;
	}
	
	function cek_judul($keyword)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
					SELECT c_id FROM tbl_news WHERE
					title LIKE '%".$keyword."%' or 
					news LIKE '%".$keyword."%' or
					shortdesc LIKE '%".$keyword."%'");
		
		$data = $sql->result_array();
		return $data;
	}
	
	function search_video($keyword,$limit, $start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
		SELECT 
			a.`id`,
			a.`title`,
			a.`shortdesc`,
			a.`news`,
			a.`c_id`,
			a.`dates`,
			a.`headline`,
			a.`publish`,
			b.`filename` AS 'name_pic',
			b.`location` as 'loc_pic',
			c.`filename` AS 'name_tpic',
			c.`location` as 'loc_tpic',
			d.`filename` AS 'name_vic',
			d.`location` as 'loc_vic'
			FROM `tbl_news` a
			LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
			LEFT JOIN `tbl_media` c ON a.`tpicID`= c.`id`
			LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
			where  a.c_id='26' AND a.title LIKE '%".$keyword."%' or a.news LIKE '%".$keyword."%' or a.shortdesc LIKE '%".$keyword."%'
			ORDER BY a.id desc limit ".$start.",".$limit."
			");
		
		$data = $sql->result_array();
		return $data;
	}
	
	function count_searchvideo($keyword)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
		SELECT 
			a.`id`,
			a.`title`,
			a.`news`,
			a.`c_id`,
			a.`dates`,
			a.`headline`,
			a.`publish`,
			b.`filename` AS 'name_pic',
			b.`location` as 'loc_pic',
			c.`filename` AS 'name_tpic',
			c.`location` as 'loc_tpic',
			d.`filename` AS 'name_vic',
			d.`location` as 'loc_vic'
			FROM `tbl_news` a
			LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
			LEFT JOIN `tbl_media` c ON a.`tpicID`= c.`id`
			LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
			where  a.c_id='26' AND a.title LIKE '%".$keyword."%' or a.news LIKE '%".$keyword."%' or a.shortdesc LIKE '%".$keyword."%'
			ORDER BY a.id desc
			");
		
		$data = $sql->result_array();
		return $data;
	}
	
}