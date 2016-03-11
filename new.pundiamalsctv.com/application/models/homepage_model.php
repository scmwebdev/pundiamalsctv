<?php  if (!defined('BASEPATH')) exit('tidak boleh masuk langsung');

class Homepage_model extends CI_Model {
		var $DB_READ 			= NULL;
		var $DB_WRITE           = NULL;
		var $tbl_category       = "tbl_category";
		var $tbl_news 	        = "tbl_news";
		var $tbl_penyumbang     = "tbl_gempa_aceh_bca";
		var $tbl_media			= "tbl_media";
		var	$tbl_ticker			= "tbl_ticker";
		

    function __construct()
	{	
        parent::__construct();   
		
		$this->DB_READ  = $this->load->database('DB_READ', true);
        $this->DB_WRITE = $this->load->database('DB_WRITE', true);
		//$this->output->enable_profiler(TRUE);

		//$this->load->library('memcached_library');
    }
	
	
	function ticker()
	{
		 $this->DB_WRITE = $this->load->database('DB_WRITE', true);
		 $sql= $this->DB_WRITE->query("SELECT * FROM `tbl_ticker` WHERE `publish` ='1' order by id desc");
			$data = $sql->result_array();
			return $data;
		 
	}
	
	
	
	function get_headline()
	{	
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
	 	$sql =$this->DB_WRITE->query("SELECT 
		a.id,
		a.title,
		a.shortdesc,
		a.dates,
		a.picid,
		a.tpicid,
		a.sponsor_id,
		b.filename,
		b.location 
		FROM tbl_news a LEFT JOIN tbl_media b  
		ON a.picID=b.id
		WHERE a.c_id IN (18,21,22,23,24,25) AND a.publish='1' AND a.sponsor_id = 0
		ORDER BY a.dates DESC limit 0,5");	
		$data = $sql->result_array();
		return $data;
		
	}
	
	 function list_terbaru() {
		
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT 
		a.id,
		a.title,
		a.shortdesc,
		a.dates,
		a.c_id,
		a.picid,
		a.tpicid,
		a.sponsor_id ,
		b.name 
		FROM tbl_news a LEFT JOIN tbl_category b  
		ON a.c_id=b.id 
		WHERE a.c_id IN (18,21,22,23,24,25) AND a.publish='1' AND a.sponsor_id = 0
        ORDER BY a.dates DESC limit 5,4");
		$data = $sql->result_array();
		return $data;	
    }
	
	function list_sebelumnya() {
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT 
										a.id,
										a.title,
										a.shortdesc,
										a.dates,
										a.c_id,
										a.picID,
										a.sponsor_id ,
										a.publish,
										b.id,
										b.name, 
										c.id,
										c.location, 
										c.filename
									FROM tbl_news a
									LEFT JOIN tbl_category b ON a.c_id=b.id 
									LEFT JOIN tbl_media c ON a.picID=c.id
									WHERE a.publish='1' 
									AND a.c_id IN (18,21,22,23,24,25) AND a.sponsor_id = 0
									ORDER BY a.dates DESC limit 9,4");
		
		$data = $sql->result_array();
		return $data;
	}
	
	
	function get_foto_terbaru(){
		
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
	 //$sql = $this->DB_WRITE->query("SELECT id,location,caption FROM ".$this->tbl_media." where type = 'tpicID' order by id desc LIMIT 0,4");
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
							LEFT JOIN tbl_media b ON a.id = b.id_gallery  GROUP BY a.title ORDER BY a.dates DESC LIMIT 0,4");
        $data = $sql->result_array();
		return $data;
		
	}
	
	function detail_kesehatan($limit, $start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (23) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
		$data = $sql->result_array();
		return $data;	

	}
	
	function kesehatan()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (23) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc");
		$data = $sql->result_array();
		return $data;	

	}
	
	function pendidikan()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (22) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc");
		$data = $sql->result_array();
		return $data;	

	}
	
	function lingkungan()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (25) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc");
		$data = $sql->result_array();
		return $data;	

	}
	
	function berita()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (21) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc");
		$data = $sql->result_array();
		return $data;	

	}
	
	function bencana()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
				SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (24) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc ");
		$data = $sql->result_array();
		return $data;	

	}
	
	function bantuan()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
				SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (20) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc ");
		$data = $sql->result_array();
		return $data;	

	}
	
	
	
	function detail_pendidikan($limit, $start)
	{
		
		
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (22) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
				
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_bantuan($limit, $start)
	{
		
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (20) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
				
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_bencana($limit, $start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (24) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_berita($limit, $start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (21) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
		$data = $sql->result_array();
		return $data;	

	}
	
	function berita_terbaru()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (22,23,24,25) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc
        ");
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_terbaru($limit, $start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (22,23,24,25) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
		$data = $sql->result_array();
		return $data;	

	}
	
	function detail_lingkungan($limit,$start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (25) and publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
		
		$data = $sql->result_array();
		return $data;	

	}
	
	function test()
	{
		die('test ajaja model ');	
	}
	
	function info_kegiatan()
	{
			
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
		SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
		FROM tbl_news a
		LEFT JOIN tbl_media c
		ON a.picid=c.id
		where  a.c_id IN (18) and publish='1' and a.sponsor_id = 0
        order by a.dates desc limit 0,3"	
    	);
		
		$data = $sql->result_array();
		return $data;
	}
	
    function list_pilar_pa()
	{
		
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql = $this->DB_WRITE->query("
		SELECT id,name,title,shortdesc,picid,tpicid FROM ".$this->tbl_category."  WHERE  pilar = '1' 	
    	");
		
		$data = $sql->result_array();
		return $data;
	}
	
	function terbaru()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT 
		a.id,
		a.title,
		a.shortdesc,
		a.dates,
		a.c_id,
		a.picid,
		a.tpicid,
		a.sponsor_id ,
		b.name, 
		b.picID,
		b.tpicid, 
		c.location, 
		c.filename
		FROM tbl_news a,tbl_category b ,tbl_media c
		where a.c_id=b.id and c.id=b.picid and publish='1' 
		and a.c_id IN (18,21,22,23,24,25) and a.sponsor_id = 0
        order by a.dates desc limit 0,3");
		
		$data = $sql->result_array();
		return $data;
	}
 
   
	
	 function list_all_terbaru() {
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT 
		id,title,shortdesc,dates,c_id,picid,tpicid,sponsor_id  
		FROM tbl_news  
		where publish='1' 
		and c_id IN (20,21,22,23,24,25) and a.sponsor_id = 0
		ORDER BY dates");
		
		$data = $sql->result_array();
		return $data;
		
    }
	

	function list_penyumbang()
	{	
	    $this->DB_READ = $this->load->database('DB_READ', true);
		
		$sql=$this->DB_READ->query("
		SELECT
		p_id, nourut, nama, jumlah, date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal,publish
		FROM tbl_gempa_aceh_bca
		WHERE publish='1' order by p_id desc limit 0,8				   
		");
		
		$data = $sql->result_array();
		//var_dump($data);
		//$data = array('test', '1', 'dua');
		
		return $data;
	}
	
	function count_penyumbang()
	{
		$this->DB_READ = $this->load->database('DB_READ', true);
		$sql=$this->DB_READ->query("
		SELECT
		p_id, nourut, nama, jumlah, publish
		FROM tbl_gempa_aceh_bca
		WHERE publish='1' order by p_id desc				   
		");
		
		$data = $sql->result_array();
		//var_dump($data);
		//$data = array('test', '1', 'dua');
		
		return $data;
	}
	
	function penyumbang($limit,$start)
	{	
	    $this->DB_READ = $this->load->database('DB_READ', true);
		
		$sql=$this->DB_READ->query("
		SELECT
		p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
		FROM tbl_gempa_aceh_bca
		WHERE publish='1' order by p_id desc limit ".$start.", ".$limit."				   
		");
		
		$data = $sql->result_array();
		//var_dump($data);
		//$data = array('test', '1', 'dua');
		
		return $data;
	}
	
	function count_carinamapenyumbang($keyword)
	{
		
			$this->DB_READ=$this->load->database('DB_READ', true);
			$sql=$this->DB_READ->query("
			SELECT
			p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
			FROM tbl_gempa_aceh_bca
			WHERE publish='1' AND nama LIKE '%".$keyword."%' order by p_id desc");
			$data = $sql->result_array();
			return $data;
	}
	
	function count_caritanggalpenyumbang($keyword)
	{
			//print_r($keyword);
			$this->DB_READ=$this->load->database('DB_READ', true);
			$sql=$this->DB_READ->query("
			SELECT
			p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
			FROM tbl_gempa_aceh_bca
			WHERE publish='1' AND date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') LIKE '%".$keyword."%' order by p_id desc");
			$data = $sql->result_array();
			return $data;
	}
	
	function count_carikotapenyumbang($keyword)
	{
			$this->DB_READ=$this->load->database('DB_READ', true);
			$sql=$this->DB_READ->query("
			SELECT
			p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
			FROM tbl_gempa_aceh_bca
			WHERE publish='1' AND kota LIKE '%".$keyword."%' order by p_id desc");
			$data = $sql->result_array();
			return $data;
		
	}
	
	function cari_namapenyumbang($keyword,$limit, $start)
	{

		$this->DB_READ=$this->load->database('DB_READ', true);
		$sql=$this->DB_READ->query("
			SELECT
			p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
			FROM tbl_gempa_aceh_bca
			WHERE nama LIKE '%".$keyword."%' and publish='1' order by p_id desc limit ".$start.", ".$limit."				   
			");
		$data = $sql->result_array();
		return $data;
	}
	function cari_tanggalpenyumbang($keyword,$limit, $start)
	{
		//print_r($keyword);
		$this->DB_READ=$this->load->database('DB_READ', true);
		$sql=$this->DB_READ->query("
			SELECT
			p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
			FROM tbl_gempa_aceh_bca
			WHERE publish='1' AND date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') LIKE '%".$keyword."%' order by p_id desc limit ".$start.", ".$limit."				   
			");
		$data = $sql->result_array();
		return $data;
	}
	
	function cari_kotapenyumbang($keyword,$limit, $start)
	{
		$this->DB_READ=$this->load->database('DB_READ', true);
		$sql=$this->DB_READ->query("
			SELECT
			p_id, nourut, nama,kota, jumlah,date_format(FROM_UNIXTIME(tanggal),'%d/%m/%Y') as tanggal, publish
			FROM tbl_gempa_aceh_bca
			WHERE publish='1' AND kota LIKE '%".$keyword."%' order by p_id desc limit ".$start.", ".$limit."				   
			");
		$data = $sql->result_array();
		return $data;
		
	}
	
	function testimoni()
	{	
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);

		$sql=$this->DB_WRITE->query("SELECT a.id as id_berita,
					a.title,
					a.news,
					a.shortdesc,
					a.dates,
					a.c_id,
					a.picid,
					a.tpicid,
					a.sponsor_id ,
					c.id ,
					c.location, 
					c.filename
				FROM tbl_news a LEFT JOIN tbl_media c
					ON a.picid=c.id
					where  a.c_id IN (28) and a.publish='1'and a.sponsor_id = 0
				ORDER BY id_berita desc limit 0,4");
		
		$data = $sql->result_array();
		//print_r($data);
		return $data;
	}
    
	function all_testimoni($limit,$start)
	{	
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		
		//$offset=0;
		
		$sql=$this->DB_WRITE->query("
                SELECT a.id,a.title,a.news,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (28) and a.publish='1' and a.sponsor_id = 0
				ORDER BY a.id desc limit ".$start.", ".$limit."
        ");
		
		// $this->db->_compile_select();  
		$data = $sql->result_array();
		//var_dump($data);
		return $data;
		
	}
	
	function count_testimoni()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		
		$sql=$this->DB_WRITE->query("SELECT 
		a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id , b.id
		FROM tbl_news a,tbl_category b 
		where a.c_id=b.id and b.id='28' and a.sponsor_id = 0  
        order by a.dates desc limit 0,4");
		
		$data = $sql->result_array();
		//var_dump($data);
		return $data;
	}
	
	function video()
	{
		
		/*$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title, tbl_news.vidID,tbl_news.picID ,tbl_news.c_id,tbl_news.sponsor_id, tbl_media.id, tbl_media.location
		FROM tbl_news 
		LEFT JOIN tbl_media 
		ON tbl_news.vidID=tbl_media.id 
		where tbl_news.c_id=26
		ORDER BY tbl_news.id desc limit 0,4");
		*/
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
			LEFT JOIN `tbl_media` c ON a.`tpicID` = c.`id`
			LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
			where  a.c_id='26'
			group by(a.`id`) order by a.`id` DESC limit 0,4");
		$data = $sql->result_array();
		//var_dump($data);
		//print_r($data);
		return $data;
		
	}
	
	function video_detail($id)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title, 
		tbl_news.vidID, tbl_news.picID, tbl_news.shortdesc, tbl_news.news,
		tbl_news.c_id, tbl_news.sponsor_id, tbl_media.id, tbl_media.location
		FROM tbl_news
		LEFT JOIN tbl_media ON tbl_news.vidID = tbl_media.id
		WHERE tbl_news.c_id =26
		and tbl_news.title=".$id."");
		
		$data = $sql->result_array();
		
		//print_r($data);
		return $data;
	}
	
	function galery_video()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title, 
		tbl_news.vidID, tbl_news.picID, tbl_news.shortdesc, tbl_news.news,
		tbl_news.c_id, tbl_news.sponsor_id, tbl_media.id, tbl_media.location
		FROM tbl_news
		LEFT JOIN tbl_media ON tbl_news.vidID = tbl_media.id
		WHERE tbl_news.c_id ='26'
		");
		
		$data = $sql->result_array();
		//print_r($data);
		return $data;
	}
	/*function video_detail($title)
	{
		$sql=$this->DB_WRITE->query("
		SELECT tbl_news.id, tbl_news.title, 
		tbl_news.vidID, tbl_news.picID, tbl_news.shortdesc, tbl_news.news,
		tbl_news.c_id, tbl_news.sponsor_id, tbl_media.id, tbl_media.location
		FROM tbl_news
		LEFT JOIN tbl_media ON tbl_news.vidID = tbl_media.id
		WHERE tbl_news.c_id =26
		and tbl_news.title=".$title."");
		
		$data = $sql->result_array();
		//print_r($data);
		return $data;
	}*/
	
	
	/*function mitra($limit,$start)
	{
		$offset=0;
		$sql=$this->DB_WRITE->query("SELECT a.id,
		a.title,
		   a.shortdesc,
		   a.dates,
		   a.picid,
		   a.tpicid,
		   a.vidid,
		   a.sponsor_id,
		b.id, b.sponsor_name
		FROM tbl_news a, tbl_sponsor b  
		WHERE a.sponsor_id=b.id AND a.publish='1' 
		ORDER BY a.dates DESC limit ".$start.",".$limit."");
		
		$data = $sql->result_array();
		return $data;
	}*/
	
	function count_infokegiatan()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (18) and publish='1' and a.`sponsor_id`=0
				ORDER BY a.id desc");
		$data=$sql->result_array();
		return $data;
	}
	
	function detail_infokegiatan($limit,$start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$offset=0;
		$sql=$this->DB_WRITE->query("SELECT a.id,a.title,a.shortdesc,a.dates,a.c_id,a.picid,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
				where  a.c_id IN (18) and publish='1' and a.`sponsor_id`=0
				ORDER BY a.id desc limit ".$start.",".$limit."");
		$data=$sql->result_array();
		return $data;
	}
	
	function mitra_count()
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("select 
										a.id,
										a.title,
										a.news,
										a.shortdesc,
										a.dates,
										a.c_id,
										a.picid,
										a.sponsor_id, 
										b.sponsor_name,
										c.location
									from tbl_news a 
										left join tbl_sponsor b on a.sponsor_id=b.id 
										left join tbl_media c on a.picid=c.id
									where  a.sponsor_id IN('1','2','3','4')");
		
		$data = $sql->result_array();
		return $data;
	}
	
	function mitra($limit, $start)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT  
										a.id,
										a.title,
										a.news,
										a.shortdesc,
										a.dates,
										a.c_id,
										a.picid,
										a.sponsor_id, 
										b.sponsor_name,
										c.location
									FROM tbl_news a 
										left join tbl_sponsor b on a.sponsor_id=b.id 
										left join tbl_media c on a.picid=c.id
									WHERE  a.sponsor_id IN('1','2','3','4')
									ORDER BY a.id desc limit ".$start.",".$limit.""
									);
		$data = $sql->result_array();
		return $data;
	}
	
	function ambilisi($id){
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT 
				a.id,
				a.title,
				a.news,
				a.shortdesc,
				a.dates,
				a.c_id,
				a.picid,
				a.sponsor_id ,
				c.location,
				c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.picid=c.id
			    WHERE a.id=".$id."");
		$data = $sql->result_array();
		return $data;
	}
	
	function artikel_terkait($id)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT id , title FROM tbl_news WHERE id <>".$id." ORDER BY dates DESC LIMIT 0,4");
		$data=$sql->result_array();
		return $data;
	}
	
	function ambilvideo($id){
		/*$sql=$this->DB_WRITE->query("SELECT a.id,a.title,a.news,a.shortdesc,a.dates,a.c_id,a.vidid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.vidid=c.id
			    WHERE a.id=".$id."");*/
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
			b.`location` AS 'loc_pic',
			c.`filename` AS 'name_tpic',
			c.`location` AS 'loc_tpic',
			d.`filename` AS 'name_vic',
			d.`location` AS 'loc_vic'
			FROM `tbl_news` a
			LEFT JOIN `tbl_media` b ON a.`picID` = b.`id`
			LEFT JOIN `tbl_media` c ON a.`tpicID` = c.`id`
			LEFT JOIN `tbl_media` d ON a.`vidID` = d.`id`
			where a.id=".$id."");
		
		$data = $sql->result_array();
		//print_r($data);
		return $data;
	}
	
	function ambilfoto($id){
	/*	$sql=$this->DB_WRITE->query("SELECT a.id,a.title,a.news,a.shortdesc,a.dates,a.c_id,a.tpicid,a.sponsor_id ,c.location, c.filename
				FROM tbl_news a
				LEFT JOIN tbl_media c
				ON a.tpicid=c.id
			    WHERE a.id=".$id."");*/
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
	
	function search_foto($keyword,$limit, $start)
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
							LEFT JOIN tbl_media b ON a.id = b.id_gallery WHERE a.title LIKE '%".$keyword."%'
							ORDER BY a.id desc limit ".$start.",".$limit."");
		$data = $sql->result_array();
		return $data;
	
	}
	
	function count_searchfoto($keyword)
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
							LEFT JOIN tbl_media b ON a.id = b.id_gallery WHERE a.title LIKE '%".$keyword."%'");
		$data = $sql->result_array();
		return $data;
	
	}
	
	function search($keyword,$limit, $start)
	{
		//print_r($keyword);
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT 
										a.id,
										a.title,
										a.news,
										a.shortdesc,
										a.dates,
										a.c_id,
										a.picid,
										a.sponsor_id,
										c.location,
										c.filename
									FROM tbl_news a LEFT JOIN tbl_media c
									ON a.picid=c.id 
									WHERE a.title LIKE '%".$keyword."%' or a.news LIKE '%".$keyword."%' or a.shortdesc LIKE '%".$keyword."%'
									ORDER BY a.id desc limit ".$start.",".$limit."
									");
		$data = $sql->result_array();
		return $data;
	}
	
	function count_search($keyword)
	{
		$this->DB_WRITE = $this->load->database('DB_WRITE', true);
		$sql=$this->DB_WRITE->query("SELECT 
										a.id,
										a.title AS judul,
										a.news AS berita,
										a.shortdesc AS desk,
										a.dates,
										a.c_id,
										a.picid AS gambar,
										a.sponsor_id,
										c.location AS lokasi,
										c.filename
									FROM tbl_news a LEFT JOIN tbl_media c
									ON a.picid=c.id 
									WHERE a.title LIKE '%".$keyword."%' or a.news LIKE '%".$keyword."%' or a.shortdesc LIKE '%".$keyword."%'
									");
		$data = $sql->result_array();
		return $data;
	}
	
	
	
	function data_kalender()
	{
		$this->DB_WRITE =$this->load->database('DB_WRITE',true);
		$sql=$this->DB_WRITE->query("
									SELECT 
									id AS id
									,c_id AS c
									,title AS judul
									,start_calender AS awal
									,finish_calender AS akhir
									FROM tbl_news WHERE C_id='18' AND start_calender !='0000-00-00 00:00:00' AND finish_calender !='0000-00-00 00:00:00'
									");
		$data = $sql->result_array();
		return $data;
	}
	
	
	
    function getAirDate($data) {
    		if ($data != "" && $data > 0) {
    				$arrHari 	= array('Sun'=>'Minggu', 'Mon'=>'Senin', 'Tue'=>'Selasa', 'Wed'=>'Rabu', 'Thu'=>'Kamis', 'Fri'=>'Jumat', 'Sat'=>'Sabtu');
    				$arrBulan = array('1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April', '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agutus', '9'=>'September', '10'=>'Oktober', '11'=>'Nopember', '12'=>'Desember');
    				$hari 		= $arrHari[date("D", $data)];
    				$tgl			= date("j", $data);
    				$bln 			= $arrBulan[date("n", $data)];
    				$thn			= date("Y", $data);
    				
    				$data 		= "$hari, $tgl $bln $thn";
    		} else {
    				$data = "";
    		}
    		
    		return $data;
    }
    
    function getAirTime($data) {
    		if ($data == "" || $data == ": - :") {
    				$data = "";
    		} else {
    				$arr = explode(" - ", $data);
    				$data = $arr[0].' WIB';
    		}
    		
    		return $data;
    }
	
	
	function getYearCopyright(){
		$d=date("Y");		
		if($d <= 2013){
			$yearCopyright="2013";
		}
		else{
			$yearCopyright="2013 - ".date("Y");
		}
		return $yearCopyright;
	}
}
