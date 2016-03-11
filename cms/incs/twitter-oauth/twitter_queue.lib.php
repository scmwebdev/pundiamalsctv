<?php

class twitterQueue {
   var $_table="tbl_twitter_queue";
   var $_tweetToPublish;
   var $mdb;
   var $recPerPage = REC_PER_PAGE;

   public function __construct()
   {
        $this->mdb = MDB2::factory(DSN_LIPUTAN6);
        $this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);
        $this->mdb->setCharset('latin1');
        $this->_tweetToPublish=array();
   }
   
   public function tweet($param=array()){
            $_query="INSERT INTO {$this->_table} (cha_id,cat_id,id,news_url,twitter_channel,twitter_status,title_to_twitter,user) VALUES('{$param["cha_id"]}','{$param["cat_id"]}','{$param["id"]}','{$param["news_url"]}','{$param["twitter_channel"]}','{$param["twitter_status"]}','{$param["title_to_twitter"]}','{$_SESSION["login"]}')"; 
            $sql = $this->mdb->prepare($_query);
            $sql->execute();   
   }
   
   
   public function getTweet($channel="no",$intTweet=2){
      if($channel=="no")
      {
	     $whereChannel = " AND (twitter_channel='$channel' OR twitter_channel='')";
      }
      else {
	     $whereChannel = " AND twitter_channel='$channel' ";
	  } 
        $_query = "SELECT *
                   FROM  {$this->_table}
                   WHERE dtupdate is NULL $whereChannel
                   ORDER BY dtcreate 
                   LIMIT $intTweet";
                   
        $result=$this->mdb->queryAll($_query);
        if (empty($result)) return FALSE;
        $this->_tweetToPublish=$result;
        return TRUE;   
   }

   public function update($id=0,$channel="no"){
        $result=$this->mdb->query("UPDATE {$this->_table} SET dtupdate=now() WHERE id=$id AND twitter_channel='$channel' ");
   }   
   public function publish($param=array()){
      // create a new cURL resource
      $ch = curl_init();
      
      // set URL and other appropriate options
      curl_setopt($ch, CURLOPT_HEADER, 0);
      
      
      // close cURL resource, and free up system resources
      
      foreach($this->_tweetToPublish as $tweet){
         // Push URL : http://local.cms.liputan6.com/incs/twitter-oauth/poptwitter-lip6.php?ch=no&id=654522&twitter=1&mod=news&publish=1
         $strurl=$param["siteURL"] ."incs/twitter-oauth/index.php?mod=news&publish=1";
         curl_setopt($ch, CURLOPT_URL, $strurl);
         curl_setopt($ch, CURLOPT_POST, true);
         $data=array(
            "id"=>$tweet["id"]
            ,"cha_id"=>$tweet["cha_id"]
            ,"cat_id"=>$tweet["cat_id"]
            ,"news_url"=>$tweet["news_url"]
            ,"submit"=>"Submit"
            ,"title_to_twitter"=>$tweet["title_to_twitter"]
            ,"twitter_channel"=>$tweet["twitter_channel"]
            ,"twitter_status"=>$tweet["twitter_status"]
            ,"user"=>$tweet["user"]                        
         );
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
         // grab URL and pass it to the browser
         $strResult=curl_exec($ch);
         //print "Hasil: $strResult <br/>\n";
         // update ke db
         $this->update($tweet["id"],$tweet["twitter_channel"]);
      }
       curl_close($ch);
  }
  
  public function totalRec()
  {
      $result=$this->mdb->query("SELECT * FROM {$this->_table}");       
      return $result->numRows();
  }
  
    /**
     * get list data
     */
    function getListData($id=0,$strSrch=null,$fldSrch=null,$page=1,$isPublish=0){
        $_fieldQuery = "a.* , c.title,b.channel_name";
        $_query = "FROM ".$this->_table." a LEFT JOIN tbl_channel b ON a.cha_id=b.channel_id LEFT JOIN tbl_news c on a.id=c.id 
            WHERE 1 ".($id?"AND id='".$id."' ":"").($isPublish?"AND dtupdate  is not null ":"");

        if(!empty($strSrch)){
            if(!empty($fldSrch)) $_query .= "AND ".$fldSrch." like '%".$strSrch."%' ";
            else {
                $_query .= "AND (title_to_twitter like '%".$strSrch."%' OR news_url like '%".$strSrch."%') ";
            }
        }
        $res = $this->mdb->queryRow("SELECT count(*) as totrec ".$_query);
        if (PEAR::isError($res)) die($res->getMessage());
        $this->totRec = $res["totrec"];

        $_query .= "ORDER BY dtcreate DESC
            LIMIT ".(($page-1)*$this->recPerPage).",".$this->recPerPage."";
        $res = $this->mdb->queryAll("SELECT ".$_fieldQuery." ".$_query);

        if (PEAR::isError($res)) die($res->getMessage());
    return $res;
    }

   function delData($param=array()){
      $this->mdb->query("DELETE FROM {$this->_table} WHERE id={$param["id"]} AND twitter_channel='{$param["twitter_channel"]}'");
   }  
}