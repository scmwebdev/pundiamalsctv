<?php

session_start();
require_once '../incs/config.inc.php';
session_cache_expire(SESS_TIME/3600);
session_name("bcms-sess");

require_once INC_DIR.'app.inc.php';

include_once 'config.php';

require_once INC_DIR.'memcached.php';
require_once LIB_DIR.'memcached_library.php';

require_once MOD_DIR.'news/generate.lib.php';

$mem = new Memcached_library();
$gen = new Generate();
//$gen->doit('home');
if (isset($_GET['ajax'])) {
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    switch($act) {
        case 'get' :
            $get = $mem->get('l6_news_for_'.$_GET['id']);
            echo '<h5 style="text-align:center">'.$get['title'].'</h5>';
            echo '<img src="'.$get['pic_url'].'">';
            echo <<<KMK
<div style="width:100%">
<h4>Detil</h4>
	<div style="width:150px">Publish:</div>
	<div style="width:150px">{$get["publish"]}</div>

</div>
KMK;
            break;
        case 'refresh' :
            $gen->doit($_GET['channel']);
            echo "success";
            break;
        default :
            $mem->delete($_GET['name']);
            echo "success";
    }
    exit;
}

$tpl->channel = isset($_GET['channel']) ? $_GET['channel'] : 'home';

switch ($tpl->channel) {
    case 'home' :
        $_key = 'l6_headline_channel_0';
        $arr_channel   = array(0 => array(24,'Terkini'),
                               1 => array(3, 'News'),
                               5 => array(3, 'Showbiz'),
                               7 => array(2, 'Bola'),
                               9 => array(3, 'Health'),
                               10=> array(3, 'Tekno'),
                               14=> array(3, 'Bisnis'),
                         );
        $arr_category  = 0;
        break;

    case 'news' :
        $_key = 'l6_headline_channel_1';
        $arr_channel   = 1;
        $arr_category  = array(0   => array(16, 'Terkini'),
                               1   => array(6, 'Politik'),
                               9   => array(2, 'Internasional'),
                               163 => array(6, 'Peristiwa'),
                               171 => array(2, 'Citizen6'),
                            );
        break;

    case 'bisnis' :
        $_key = 'l6_headline_channel_14';
        $arr_channel   = 14;
        $arr_category  = array(0   => array(16, 'Terkini'),
                               173 => array(6, 'Ekonomi'),
                               174 => array(6, 'Bank'),
                               175 => array(2, 'Saham'),
                               176 => array(2, 'Energi & Tambang'),
                            );
        break;

    case 'bola' :
        $_key = 'l6_headline_channel_7';
        $arr_channel   = 7;
        $arr_category  = array(0  => array(16, 'Terkini'),
                               55 => array(2, 'Corner'),
                               56 => array(2, 'Bintang'),
                               57 => array(6, 'Wawancara'),
                               58 => array(2, 'Prediksi'),

                               60 => array(4, 'Liga Inggris'),
                               61 => array(4, 'Liga Italia'),
                               62 => array(4, 'Liga Spanyol'),
                               63 => array(4, 'Liga Jerman'),
                               64 => array(4, 'Liga Belanda'),
                               65 => array(4, 'Liga Perancis'),
                               66 => array(4, 'Liga Eropa'),
                               67 => array(4, 'Piala Dunia'),
                               69 => array(4, 'Liga Nasional'),

                            );
        break;

    case 'showbiz' :
        $_key = 'l6_headline_channel_5';
        $arr_channel   = 5;
        $arr_category  = array(0   => array(16, 'Terkini'),
                               48  => array(2, 'Movie'),
                               49  => array(6, 'Celeb'),
                               158 => array(5, 'Musik'),
                               172 => array(2, 'K-Pop'),
                               );
        break;

    case 'health' :
        $_key = 'l6_headline_channel_9';
        $arr_channel   = 9;
        $arr_category  = array(0   => array(16, 'Terkini'),
                               72  => array(6, 'Info'),
                               137 => array(6, 'Seks'),
                               140 => array(2, 'Diet'),
                               143 => array(2, 'Fit'),
                            );
        break;

    case 'tekno' :
        $_key = 'l6_headline_channel_10';
        $arr_channel   = 10;
        $arr_category  = array(0   => array(16, 'Terkini'),
                               146 => array(6, 'Gadget'),
                               149 => array(6, 'Internet'),
                               152 => array(2, 'Game'),
                               155 => array(2, 'Telko'),
                              );
        break;
}

//$list = $tpl->data[$tpl->channel]['memcached'];


$tpl->list = array();

if ($tpl->channel == 'home') {
    $_key = 'l6_headline_channel_0';
    $tpl->list[] = array('Headline', $_key, array('data'=>$mem->get($_key)));

    $_key = 'terpopuler_0_0_0_0_38';
    $tpl->list[] = array('Terpopuler', $_key, array('data'=>$mem->get($_key)));

    $_key = 'l6_list:channel_0:cat_0:subsite_0:nst_0:limit_6';
    $tpl->list[] = array('Terkini gambar', $_key, $mem->get($_key));
    foreach($arr_channel as $k => $v) {
        $_key = 'l6_list:channel_'.$k.':cat_0';
        $_key.= ':subsite_0:nst_0:limit_'.$v[0];
        $tpl->list[] = array($v[1], $_key, $mem->get($_key));
    }
    //for citizen6
    $_key = 'l6_list:channel_1:cat_171:subsite_0:nst_0:limit_2';
    $tpl->list[] = array('Citizen6', $_key, $mem->get($_key));
} else {
    $_key = 'l6_headline_channel_'.$arr_channel;
    $tpl->list[] = array('Headline', $_key, array('data'=>$mem->get($_key)));

    $_key = 'terpopuler_'.$arr_channel.'_0_0_0_22';
    $tpl->list[] = array('Terpopuler', $_key, array('data'=>$mem->get($_key)));

    $_key = 'l6_list:channel_'.$arr_channel.':cat_0:subsite_0:nst_0:limit_6';
    $tpl->list[] = array('Terkini gambar', $_key, $mem->get($_key));
    foreach($arr_category as $k => $v) {
        $_key = 'l6_list:channel_'.$arr_channel.':cat_'.$k;
        $_key.= ':subsite_0:nst_0:limit_'.$v[0];
        $tpl->list[] = array($v[1], $_key, $mem->get($_key));
    }
}

//echo "<pre>"; print_r($tpl->list); die;



$tpl->display('memcached.tpl.php');

$bauth->disconnect();
?>
