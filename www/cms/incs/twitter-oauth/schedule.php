<?php
    /**
     * @file
     * User has successfully authenticated with Twitter. Access tokens saved to config file.
     */

    session_start();

    require_once('config.php');

    //* Load required lib files for CMS Liputan6.com  */
    require_once("../config.inc.php");
    require_once("../function.inc.php");
    
    require_once PEAR_DIR.'MDB2.php';
	 require_once "twitter_queue.lib.php";
	 
	 $tweetQueue= new twitterQueue();
	 $channelTwitter=isset($_GET["channel"]) ? $_GET["channel"] : "no";
	 if($tweetQueue->getTweet($channelTwitter)){
	    // Jika ada data yang akan di tweet, tweet
	    $tweetQueue->publish(array("siteURL"=>$siteURL));
	 }


       
    