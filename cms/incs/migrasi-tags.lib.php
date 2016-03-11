<?php
class migrasitags{

    var $mdb = null;
    //var $first_id = 523000;
    var $first_id = 450000;
    var $last_id  = 628200;

    function migrasitags(){
        $this->mdb = MDB2::factory(DSN_LIPUTAN6);
        $this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);
    }

    function selectData($p=0,$batas=100){
        $sql = "
            SELECT n.id, n.prehead, n.subtitle, n.terkait, n.keyword, n.cat_id, c.channel_id AS cha_id
            FROM tbl_news n
            INNER JOIN tbl_category c ON n.cat_id = c.cat_id 
            WHERE 1 " .
            ($this->first_id > 0 ? ' AND n.id >= '.$this->first_id : '').
            ($this->last_id > 0 ? ' AND n.id <= '.$this->last_id : '').
            " order by n.id desc limit $p, $batas";
        $result = $this->mdb->queryAll($sql);

        return $result;
    }

    function setTags($tags, $news_id, $cat_id, $cha_id){
        $tags_id    = array();
        $tag_arr    = explode(",", $tags);

        foreach($tag_arr as $tag) {
            if (trim($tag) != '') $tags_id[] = $this->getTagID(trim($tag));
        }

        $sqlDel = "DELETE FROM tbl_tags_news WHERE news_id = ".$news_id;
		$res1 = $this->mdb->exec($sqlDel);
		
        $result = array_unique($tags_id);
        foreach($result as $tag_id) {
            $sql = 'INSERT INTO tbl_tags_news (news_id,tag_id,cha_id,cat_id)
                    VALUES ('.$news_id.','.$tag_id.','.$cha_id.','.$cat_id.')';
            $this->mdb->exec($sql);
        }
    }

    function getTagID($name) {
        $slug = url_title($name);
        $sql = "SELECT id
                FROM tbl_tags  
                WHERE slug = '" . $slug . "'";
        $row = $this->mdb->queryRow($sql);
        
        if (PEAR::isError($row)) die($row->getMessage());
        
        if (empty($row)) {
            $_sql = 'INSERT INTO tbl_tags SET
                     name = "'.trim(preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $name)).'",
                     slug = "'.$slug.'"';
            $this->mdb->exec($_sql);
            
            return $this->mdb->lastInsertID('tbl_tags', 'id');
        } else {
            return $row['id'];
        }
    }
    
    function getTotalData(){
        $sql = "SELECT count(n.id) as total
                FROM tbl_news n 
                INNER JOIN tbl_category c ON n.cat_id = c.cat_id 
                WHERE 1 " .
				($this->first_id > 0 ? ' AND n.id >= '.$this->first_id : '').
				($this->last_id > 0 ? ' AND n.id <= '.$this->last_id : '').
                " AND n.cat_id = c.cat_id";
        $row = $this->mdb->queryRow($sql);

        return $row['total'];
    }

    function disconnect(){
        $this->mdb->disconnect();
    }
}
?>