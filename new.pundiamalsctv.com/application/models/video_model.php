<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Video_model extends CI_Model {
    function __construct() {
        parent::__construct();
        //$this->load->database();
    }
    
    function listVideo($page,$batas) {				
				$sql 		= "select vid_id,vid_title,vid_slug,vid_url_source,vid_url_id from tbl_video where vid_publish=1 order by vid_id desc limit $page, $batas";
	    	$query 	= $this->db->query($sql);
	    	$data		= $query->result_array();
	    	$query->free_result();
	    	
	    	return $data;
		}

		function listVideoLainnya($vid,$batas=10) {				
				$sql 		= "select vid_id,vid_title,vid_slug,vid_url_source,vid_url_id from tbl_video where vid_publish=1 and vid_id<>$vid order by vid_id desc limit $batas";
	    	$query 	= $this->db->query($sql);
	    	$data		= $query->result_array();
	    	$query->free_result();
	    	
	    	return $data;
		}
		
		function listVideoTerkait($vid,$vid_parent) {				
				$sql 		= "select vid_id,vid_title,vid_slug,vid_url_source,vid_url_id from tbl_video where vid_publish=1 and vid_id<>$vid and ".(($vid_parent > 0) ? "(vid_parent_id=$vid_parent or vid_id=$vid_parent)" : "vid_parent_id=$vid")." order by vid_title";
	    	$query 	= $this->db->query($sql);
	    	$data		= $query->result_array();
	    	$query->free_result();
	    	
	    	return $data;
		}
		
		function getNumRows($abjad="") {
				$sql = "select count(vid_id) as num_rows from tbl_video where vid_publish=1";
				$query = $this->db->query($sql);
				$data = $query->row_array();
				$query->free_result();
				
				return $data['num_rows'];
		}
		
    function getDetail($vid_id) {
    		if (is_numeric($vid_id)) {
						$sql = "select * from tbl_video where vid_publish=1 and vid_id=$vid_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();
						
						return $data;
    		} else {
    				return array();
    		}
    }
    
    function listSinopsis($vid_id) {
    		if (is_numeric($vid_id)) {
						$sql = "select s.s_id,s.s_program_title,s.judul_url,c.c_slug from tbl_sinopsis s inner join tbl_sinvid sv on s.s_id=sv.s_id inner join tbl_cat_program c on s.s_cat_program=c.c_id where s.s_publish=1 and sv.vid_id=$vid_id";
						$query = $this->db->query($sql);
						$data = $query->result_array();
						$query->free_result();
						
						return $data;
    		} else {
    				return array();
    		}
    }
    
    function listBioArtis($vid_id) {
    		if (is_numeric($vid_id)) {
						$sql = "select b.bio_id,b.bio_name,b.bio_slug from tbl_bio_actress b inner join tbl_biovid bv on b.bio_id=bv.bio_id where b.bio_publish=1 and bv.vid_id=$vid_id";
						$query = $this->db->query($sql);
						$data = $query->result_array();
						$query->free_result();
						
						return $data;
    		} else {
    				return array();
    		}
    }
    
    function listPicture($vid_id) {
    		if (is_numeric($vid_id)) {
						$sql = "select p.id,p.caption,p.caption_slug,p.headline_image,p.thmb_image,p.big_image from tbl_pictures p inner join tbl_biopic bp on p.id=bp.pic_id where p.publish=1 and bp.vid_id=$vid_id";
						$query = $this->db->query($sql);
						$data = $query->result_array();
						$query->free_result();
						
						return $data;
    		} else {
    				return array();
    		}
    }
       
    function getBioPic($vid_id, $img_type="") {
    		$data = array();
    		$sql = "select caption,headline_image,big_image,thmb_image from tbl_pictures p inner join tbl_biopic bp on p.id=bp.pic_id where ".(($img_type == "") ? "" : "$img_type<>'' and")." p.publish=1 and bp.vid_id=$vid_id limit 1";
    		$query = $this->db->query($sql);
    		$data = $query->row_array();
    		$query->free_result();
    		
    		return $data;
    }
    
    function addCounter($data_id) {
    		$this->DBWRITE = $this->load->database('dbwrite', true);
    		$sql = "update tbl_video set vid_counter=vid_counter+1 where vid_id=".$data_id;
    		$this->DBWRITE->query($sql);
    }
}