<?php

session_start();
define("CHANNEL_ID", "config");
define("MODULE", 'config');
require_once '../incs/config.inc.php';
session_cache_expire(SESS_TIME/3600);
session_name("bcms-sess");
require_once INC_DIR.'app.inc.php';

$tpl->title  = 'Config Main Page';
$tpl->module = MODULE;

require_once INC_DIR.'mod.lib.php';
$bmod = new Mod();

// admin list all
$arr_mod = $bmod->getData(MODULE, 'parent_id');
if($_SESSION["login"] == "admin") {
    $tpl->mod = $arr_mod;
} else {
    foreach($arr_mod as $k => $v){
        if($bauth->checkAuth($v["id"],"view")) $list_mod[] = $arr_mod[$k];
    }
    $tpl->mod = (count($list_mod)?$list_mod:array());
}

//--load ino popups
require_once MOD_DIR.'info.lib.php';
$inf = new Info();
$tpl->popup = $inf->getListData();
$inf->disconnect();

$bmod->disconnect();

$tpl->display('config/main.tpl.php');

$bauth->disconnect();
?>
