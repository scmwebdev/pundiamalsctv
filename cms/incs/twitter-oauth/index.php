<?php
    /**
     * @file
     * User has successfully authenticated with Twitter. Access tokens saved to config file.
     */

    session_start();

    /* Load required lib files for Twitter. */
    require_once('twitteroauth/twitteroauth.php');
    require_once('config.php');

    //* Load required lib files for CMS Liputan6.com  */
    require_once("../config.inc.php");
    require_once("../function.inc.php");
    require_once("../memcached.php");
    session_cache_expire(SESS_TIME/3600);
    session_name("bcms-sess");
    require_once PEAR_DIR.'MDB2.php';
    require_once INC_DIR.'auth.lib.php';

    $bauth = new Auth();
    $bauth->checkSession();

    // ....check auth
    if(!empty($_SESSION["login"]) && $_SESSION["login"] == "admin") define("URIGHT", 1);
    else {
        if(!$bauth->checkAuth(@$_REQUEST["mod"],"add")) define("URIGHT", 0);
        else define("URIGHT", 1);
    }


    if(!$bauth->checkSession() && URIGHT || $_REQUEST["publish"]==1){

    if($_REQUEST["mod"]=='tv-video'){
        require_once MOD_DIR.'tv-video.lib.php';
        $bcms = new tvvideo();
    }else{
        require_once MOD_DIR.'news/news.lib.php';
        $bcms = new News();
    }
   

    if(isset($_REQUEST["title_to_twitter"]) && isset($_REQUEST["publish"])){
        
        if (isset($_REQUEST['twitter_channel']) && $_REQUEST['twitter_channel'] == 'yes') {
            $cha_id = $_REQUEST["cha_id"];
            $cat_id = $_REQUEST["cat_id"];
            
            $CONSUMER_KEY = $CONSUMER_SECRET = $OAUTH_TOKEN = $OAUTH_TOKEN_SECRET = '';
            
            switch ($cha_id) {
                case 10: // tekno
                    $CONSUMER_KEY          = 'ExvTbKZ0Hrwvu2fWY39w';
                    $CONSUMER_SECRET       = 'OxURyPY6Mtya5j0qM1JOKWPPZvUPWNOL2nlboDocDhM';
                    $OAUTH_TOKEN           = '1435437240-gGRakYln9mGr32GUjkvnRTip5fuFtB9w0VoJBCc';
                    $OAUTH_TOKEN_SECRET    = 'EZEbY4jiByUipeeNqK2cD6QZ5Nc8tPSGr4V1xmdgg';
                    break;
                     
                case 9: // health
                    $CONSUMER_KEY          = 'jaMh7oEvTJiK1IZs3z1fg';
                    $CONSUMER_SECRET       = 'H8yiCUcgPsbyrcKEE6pgoX23touYTBQUlPsvrHEIQog';
                    $OAUTH_TOKEN           = '1435475706-XpPBJpEJdzE856tiFfT4ROQ2jyswlGBzPhqFgVJ';
                    $OAUTH_TOKEN_SECRET    = 'XzQ3iyHWszW1uAZrv4nZTkSlAtUeD6EaQUAVtMRpRIo';
                    break;
                     
                case 5: // showbiz
                    $CONSUMER_KEY          = '14NFVE02NQqMQYqXkDpggQ';
                    $CONSUMER_SECRET       = 'QPN73d03NT2HtaYiqmsdLaZdy7AWO4CG7mrsnskg0U';
                    $OAUTH_TOKEN           = '1435543051-dc2Cv7tM7b5OpF9dIAXuIJaDXd4hSALdr1nENEd';
                    $OAUTH_TOKEN_SECRET    = 'hJuNDXGbDSWjT9brfC1RlfTaE4B0c0hdvV4ECCuJI';
                    break;
                     
                case 7: // bola / sports
                    $CONSUMER_KEY          = 'V7N6Q9VsMX44U3ObNDsOA';
                    $CONSUMER_SECRET       = 'NxeVIFSLj5YkLGJuolZzZ0Rt1vNo8cFs9ZcMmCPJPd0';
                    $OAUTH_TOKEN           = '1464330714-XHE86jxvH8iBB27hb3guSL5EPNAbZyU8enVkWDs';
                    $OAUTH_TOKEN_SECRET    = 'qiTrIqS5MJy5tz9UyTjNkC9sRQafoscke930F5ScM';
                    break;
                    
                case 14: // bisnis
                    $CONSUMER_KEY          = 'OTrdEAZpUi15TO7g5CHQRg';
                    $CONSUMER_SECRET       = 'dlCBdWVxItPgdHgeQ0fbKGMoeTGRxgihvY8WK4QdAH8';
                    $OAUTH_TOKEN           = '1464385388-q2YnuefJvbMC4WUqAIFnzQJpgCWYADKGluhBoZs';
                    $OAUTH_TOKEN_SECRET    = 'Jr3JnH9tIkcGF15Gd0nhDeo8vd4wikidGt6UYNk';
                    break;
                
                default:
                    if ($cat_id == '171') { // Citizen6
                        $CONSUMER_KEY          = 'npaAtyv7u9iKRRjG2n7Wg';
                        $CONSUMER_SECRET       = 'BHCHsnTGrZHwaidpiSFTpzJU0jr48EYWsosb2gCd8Q';
                        $OAUTH_TOKEN           = '1464398348-o4yJJbvbllW7Ce5EMHb9PP1Rx2tQkhtgssAhj2Z';
                        $OAUTH_TOKEN_SECRET    = 'FZDjwvYvGWQ2IEXXIEnezKhhCLnNSCeBx4U2BKc';
                    } else {
                        $CONSUMER_KEY          = CONSUMER_KEY;
                        $CONSUMER_SECRET       = CONSUMER_SECRET;
                        $OAUTH_TOKEN           = OAUTH_TOKEN;
                        $OAUTH_TOKEN_SECRET    = OAUTH_TOKEN_SECRET;
                    }
            }

            $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $OAUTH_TOKEN, $OAUTH_TOKEN_SECRET);
            
        } else {
            
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);
            
        }

        /* If method is set change API call made. Test is called by default. */
        $content = $connection->get('account/verify_credentials');

        $isi_status = $_REQUEST["title_to_twitter"]." ".$_REQUEST["news_url"];
        //$isi_status = "Alhamdulillah...sedikit demi sedikit ada pencerahan...!!!!";

        /* Tweet to Twitter ......... */
        $isi_status_arr = $connection->post('statuses/update', array('status' => $isi_status ));
        //print_r($isi_status);

        /* Ubah Status Twitter jadi 1 / Tombol menjadi Nonaktif ......... */
        if (isset($_REQUEST['twitter_channel']) && $_REQUEST['twitter_channel'] == 'yes') {
            $bcms->twitterData($_REQUEST["id"],$_REQUEST["twitter_status"],true);
        } else {
            $bcms->twitterData($_REQUEST["id"],$_REQUEST["twitter_status"],false);
        }

        /* Twitter Log */
        if(!isset($_SESSION["login"]))
        {
            $_SESSION["login"]=isset($_REQUEST["user"]) ? $_REQUEST["user"]:"-";        
        }
        $bcms->logTwitter($_REQUEST["id"],$_REQUEST["news_url"]);

         if(isset($_REQUEST["publish"]))
         {
            echo "ok";exit;
         }
         {
        echo "<b>Tweet ".($_REQUEST["mod"]=='tv-video'?"Video":"News")." to Twitter</b>";
        echo "<br><br>";
        echo "<b>".($_REQUEST["mod"]=='tv-video'?"Video":"News")." Title :</b> ".$_REQUEST["title_to_twitter"];
        echo "<br><br><b>SUKSES</b> ";
        echo "<br>";
         }
        //echo $_REQUEST["news_url"];


    } else {
       try{
          // Masukkan ke table antrian
          require_once "twitter_queue.lib.php";
          $tweetQueue = new twitterQueue();
          $tweetQueue->tweet(array(
            "cha_id"=>$_REQUEST["cha_id"]
            ,"cat_id"=>$_REQUEST["cat_id"]
            ,"id"=>$_REQUEST["id"]
            ,"news_url"=>$_REQUEST["news_url"]
            ,"twitter_channel"=>$_REQUEST["twitter_channel"]
            ,"twitter_status"=>$_REQUEST["twitter_status"]
            ,"title_to_twitter"=>$_REQUEST["title_to_twitter"]
          ));
           /* Ubah Status Twitter jadi 1 / Tombol menjadi Nonaktif ......... */
           if (isset($_REQUEST['twitter_channel']) && $_REQUEST['twitter_channel'] == 'yes') {
               $bcms->twitterData($_REQUEST["id"],$_REQUEST["twitter_status"],true);
           } else {
               $bcms->twitterData($_REQUEST["id"],$_REQUEST["twitter_status"],false);
           }
   
   
           echo "<b>Tweet ".($_REQUEST["mod"]=='tv-video'?"Video":"News")." to Twitter</b>";
           echo "<br><br>";
           echo "<b>Sudah masuk antrian</b>";
           echo "<br>";
        }catch (Exception $e) {
           echo "<b>GAGAL ...!!!</b>, Coba Ulangi Lagi ! <br/>\n";
            echo 'Pesan Error: ',  $e->getMessage(), "\n";
         }
    }

?>

<script type="text/javascript">

    function tutupRefresh() {
        parent.location.reload();
        parent.$.fancybox.close();
    }

</script>

<!-- <a href="javascript:opener.location.reload();">Reload Page A</a> -->
<br>
<input class="pub" name="close" type="button" value="Close" onClick="tutupRefresh()"/>



<? }else{
echo "Sorry. You can't access the page.<br/>";
echo "Please, Contact your administrator...";
};

/* CMS Liputan6.com ............................  END */

?>
