<?

    session_start();
    define("CHANNEL_ID", "liputan6-tv");
    require_once '../incs/config.inc.php';
    session_cache_expire(SESS_TIME/3600);
    session_name("bcms-sess");
    require_once INC_DIR.'app.inc.php';
    require_once INC_DIR.'function.inc.php';
    require_once MOD_DIR.'tv-video.lib.php';
    require_once INC_DIR.'memcached.php';
    $bcms    = new tvvideo();
    $video   = $bcms->generateMemVideoPaketRss($_REQUEST['id']);

    $picture = (!empty($video[0]['picid'])?MEDIA_LIPUTAN6.$bcms->getDetailVideoFile($video[0]['picid']):"");

    $rss = '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/"><channel>';
    foreach($video as $row){
        for($i=1;$i<=200;$i++){
            if($row['vidid_'.$i]){
                $data     = $bcms->getDetailVideoFile($row['vidid_'.$i]);

                $rss .= '
                <item>
                <media:content url="'.MEDIA_LIPUTAN6.$data.'" type="video/x-flv" duration="" />
                <media:thumbnail url="'.$picture.'" />
                </item>
                ';
            }
        }
    }
    $rss .= '</channel></rss>';
    echo $rss;

?>
