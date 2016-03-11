<?php
    session_start();

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

    if(!$bauth->checkSession() && URIGHT){

        // Rutin FB Cek
        include("facebook.php");
        
        $appid      = '160621007401976';
        $appsecret  = '1e73f1891e9ec76712516f1915b21837';
        $pageID     = '36786411434';
        //$pageID     = '344944405525823';
        
         
        $facebook = new Facebook(array(
            'appId' => $appid,
            'secret' => $appsecret,
            'cookie' => true
        ));
    
        $user = $facebook->getUser();
        if (!$user) die('<p align="center"><a href="#" onclick="parent.$.fancybox.close()">CLOSE</a></p>');
        
        $user_profile   = $facebook->api('/me');
        $user_token     = $facebook->getAccessToken();
        
        $accounts   = $facebook->api('/me/accounts?access_token='.$user_token);
        $page_token = 0;
        $page_name = '';
        foreach ($accounts['data'] as $account) {
            if ($account['id'] == $pageID) {
                $page_token = $account['access_token'];
                $page_name  = $account['name'];
            }
        }
        
        if (empty($page_token)) die('<p align="center"><a href="#" onclick="parent.$.fancybox.close()">CLOSE</a></p>');
        // end FB Cek


    if($_REQUEST["mod"]=='tv-video'){
        require_once MOD_DIR.'tv-video.lib.php';
        $bcms = new tvvideo();
    }else{
        require_once MOD_DIR.'news/news.lib.php';
        $bcms = new News();
    }


    if(isset($_REQUEST["fb_message"])){

        $fbpost = array();    
        $fbpost['access_token'] = $page_token;
        $fbpost['message']      = $_REQUEST["fb_message"]." ".$_REQUEST["news_url"];
        $fbpost['link']         = $_REQUEST["news_url"];
        //$fbpost['description']  = "The Voice Indonesia is Coming";
        //$fbpost['caption']      = "The Voice Indonesia";
        //$fbpost['picture']      = $fbimg;
        
        $res = $facebook->api('/'.$pageID.'/feed', 'POST', $fbpost);
        $status = explode("_", $res['id']);
        
        /* Ubah Status Facebook menjadi Nonaktif ......... */
        $bcms->facebookData($_REQUEST["id"],$status[1]);

        /* Facebook Log */
        //$bcms->logFacebook($_REQUEST["id"],$_REQUEST["news_url"]);

        echo "<b>Send ".($_REQUEST["mod"]=='tv-video'?"Video":"News")." to Facebook Fan Page</b>";
        echo "<br><br>";
        echo "<b>".($_REQUEST["mod"]=='tv-video'?"Video":"News")." Title :</b> ".$_REQUEST["fb_message"];
        echo "<br><br><b>SUKSES</b> ";
        echo "<br>";
        //echo $_REQUEST["news_url"];

    } else {
        echo "<b>Send ".($_REQUEST["mod"]=='tv-video'?"Video":"News")." to Facebook Fan Page</b>";
        echo "<br><br>";
        echo "<b>GAGAL ...!!!</b>, Coba Ulangi Lagi ! ";
        echo "<br>";
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
