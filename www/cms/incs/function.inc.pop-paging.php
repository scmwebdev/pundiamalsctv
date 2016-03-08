<?php
// Logging and Paging  System special for sinopsis pop-up window

/**
	 * loggin system 
	 */
	function logging($act=null){
    $mdbLog = MDB2::factory(DSN);
		$mdbLog->setFetchMode(MDB2_FETCHMODE_ASSOC);
	  if(LOGGING == "monthly" || LOGGING == "all"){
	    $strTable = (LOGGING=="monthly"?LOGGING_PREFIX.date("Ym"):LOGGING_PREFIX."all");
	    $_query = "SHOW TABLES FROM db_bcms LIKE '".$strTable."'";
	    $res = $mdbLog->queryAll($_query);
	    if (PEAR::isError($res)) die($res->getMessage());

	    if(count($res)=="0"){ // create table
	      $_create = "
	        CREATE TABLE `".$strTable."` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            `login` VARCHAR( 20 ) NOT NULL ,
            `datetime` DATETIME NOT NULL ,
            `ip` VARCHAR( 20 ) NOT NULL ,
            `query` TEXT NOT NULL,
            INDEX ( `login` , `ip` ) )
	        ";
	      $res = $mdbLog->exec($_create);
	      if (PEAR::isError($res)) die($res->getMessage());
	    }
	    
	    $_insert = "INSERT INTO ".$strTable."(`id`,`login`,`datetime`,`ip`,`query`) VALUES(
	      '','".$_SESSION["login"]."',NOW(),'".$_SERVER["REMOTE_ADDR"]."','".$act."') ";
	    $res = $mdbLog->exec($_insert);
	    if (PEAR::isError($res)) die($res->getMessage());
	  }
	  $mdbLog->disconnect();
	}
	
  /**
	 * get pagging
	 */
	function getPagging($strUrl=null,$page=1,$totRec=0,$recPerPage=0){
		
		$strPage = "";
		$strUrl .= "&page=";
		
		$i_add = floor(($page-1)/10)*10;
		$totPage = ceil($totRec/($recPerPage?$recPerPage:REC_PER_PAGE));
		$poppage = "&return1=document.myForm.txtLinkId&return2=document.myForm.txtLinkTitle&return3=document.myForm.txtShortLine&return4=document.myForm.sc_title";
		
		for($i=1;$i<=10;$i++){
			$_page = $i+$i_add;
			if($_page <= $totPage){
				if($_page == $page) $strPage .= '<b>'.$_page.'</b> ';
				else $strPage .= '<a href="'.$strUrl.$_page.$poppage.'" class="pagging">'.$_page.'</a> ';
			}
		}
		
		$first = '<a href="'.$strUrl.'1'.$poppage.'" class="pagging"><<</a> <a href="'.$strUrl.$i_add.$poppage.'" class="pagging"><</a> ';
		$last = '<a href="'.$strUrl.($i_add+11).$poppage.'" class="pagging">></a> <a href="'.$strUrl.$totPage.$poppage.'" class="pagging">>></a> ';
		
		if($i_add) $strPage = $first.$strPage;
		if(10+$i_add < $totPage) $strPage = $strPage.$last;
		
		return $strPage;
	}
	

?>
