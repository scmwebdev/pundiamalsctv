<?php

session_start();
define("CHANNEL_ID", "config");
require_once '../incs/config.inc.php';
session_cache_expire(SESS_TIME/3600);
session_name("bcms-sess");

// if mod = null
if(empty($_GET["mod"])) header("Location: ".CMS_URL);

require_once INC_DIR.'app.inc.php';

// menu on login
if(!empty($_SESSION['login'])){
    require_once INC_DIR.'mod.lib.php';
    $bmod = new Mod();

    // admin list all
    $arr_mod = $bmod->getData('config','parent_id');
    if($_SESSION["login"] == "admin") {
        $tpl->mod = $arr_mod;
    } else {
        foreach($arr_mod as $k => $v){
            if($bauth->checkAuth($v["id"],"view")) $list_mod[] = $arr_mod[$k];
        }
        $tpl->mod = (count($list_mod)?$list_mod:array());
    }
    $bmod->disconnect();
}


// have user right
if(URIGHT) {

    define("REC_URI", CMS_URL.CHANNEL_ID."/module.php?mod=".MODULE);

    if (! file_exists(MOD_DIR.CHANNEL_ID.'/'.MODULE.'.adm.php')) {
        header('Location: '.CMS_URL.CHANNEL_ID);
    }

    require_once MOD_DIR.CHANNEL_ID.'/'.MODULE.'.adm.php';

    $tpl->module = MODULE;
    $tpl->url = REC_URI;

}

$tpl->ugroup = UGROUP;
$tpl->display(CHANNEL_ID.'/'.MODULE.'.tpl.php');

// end
$bauth->disconnect();
?>
