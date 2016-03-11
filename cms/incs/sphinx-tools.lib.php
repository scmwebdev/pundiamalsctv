<?php

class sphinxtools{

    var $mdb = null;
    var $first_id = 300000;
    var $last_id  = 600918;
    function __construct(){
        $this->mdb = MDB2::factory(DSN_LIPUTAN6);
        $this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);
    }

    function selectData($p=0,$batas=100){
        $sql = "
            SELECT n.id, n.prehead, n.title, n.shortdesc, n.news, n.cat_id AS c_id, n.headline,
                c.channel_id AS ch_id, n.su_id, n.nst_id, n.headlinesubsite AS headlinesub,
                pilihan, highlight, IF(vidID>0, 1, 0) AS video,
                UNIX_TIMESTAMP(n.publish_date) as publish_date,
                n.terkait, n.keyword, n.subtitle, n.login_reporter AS reporter, n.login_redaktur AS redaktur
            FROM tbl_news n, tbl_category c
            WHERE n.publish = '1' " .
            ($this->first_id > 0 ? ' AND n.id >= '.$this->first_id : '').
            ($this->last_id > 0 ? ' AND n.id <= '.$this->last_id : '').
            " AND n.cat_id = c.cat_id order by n.id desc limit $p, $batas";
        $result = $this->mdb->queryAll($sql);
        return $result;
    }

    function replaceSphinx($row){
        $sphinx = new PDO(SPHINX_DSN);
        $_query  = "REPLACE INTO newsrt1 (id, prehead, title, shortdesc, news, terkait, keyword, subtitle, reporter, redaktur,
                      c_id, headline,ch_id,su_id,nst_id,headlinesub,pilihan,highlight,video,publish_date) VALUES ";
        $_query .= "(".$row['id'].",'".$row['prehead']."','".$row['title']."','".$row['shortdesc']."','".$row['news']."',
                   '".$row['terkait']."','".$row['keyword']."','".$row['subtitle']."','".$row['reporter']."','".$row['redaktur']."',
                   ".$row['c_id'].",".$row['headline'].",".$row['ch_id'].",".($row['su_id']?$row['su_id']:0).",
                   ".($row['nst_id']?$row['nst_id']:0).",".$row['headlinesub'].",".$row['pilihan'].",".$row['highlight'].",
                   ".$row['video'].",".$row['publish_date'].")";
        $sql = $sphinx->prepare($_query);

        $sql->execute();
    }

    function deleteSphinx($row){
        $sphinx = new PDO(SPHINX_DSN);
        $_query = "DELETE FROM newsrt1 WHERE id = ".$row['id'];
        $sql = $sphinx->prepare($_query);
        $sql->execute();
    }

    function getTotalData(){
        $sql = "SELECT count(n.id) as total
                FROM tbl_news n, tbl_category c
                WHERE n.publish = '1'" .
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
