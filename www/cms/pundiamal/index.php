<?php
session_start();
define("CHANNEL_ID", "pundiamal");
define("MODULE", CHANNEL_ID);
require_once '../incs/config.inc.php';
session_cache_expire(SESS_TIME/3600);
session_name("bcms-sess");
require_once INC_DIR.'app.inc.php';

$tpl->title = (empty($_SESSION['login'])?'Please login first.':'Main Page');
$tpl->module = MODULE;

// login proses
if(!empty($_POST['username']) && !empty($_POST['password'])){
	if($bauth->checkLogin($_POST['username'],$_POST['password'])){
		$_SESSION['login'] = $_POST['username'];
		$_SESSION['lastsession'] = time();
		header("Location: ".CMS_URL.CHANNEL_ID);
	}	else {
		session_unset($_SESSION["login"]);
		session_destroy();
	}
}

// logout proses
if(!empty($_GET['act']) && $_GET['act'] == 'logout'){
	@session_unset($_SESSION["login"]);
	session_destroy();
}

// menu on login
if(!empty($_SESSION['login'])){
	require_once INC_DIR.'mod.lib.php';
	$bmod = new Mod();

  // admin list all
  if($_SESSION["login"] == "admin"){
    $tpl->mod = $bmod->getData(CHANNEL_ID,"parent_id");
		defined("UGROUP") || define("UGROUP", 1);
  } else {
    $arr_mod = $bmod->getData(CHANNEL_ID,"parent_id");
    foreach($arr_mod as $k => $v){
      if($bauth->checkAuth($v["id"],"view")) $list_mod[] = $arr_mod[$k];
    }
    $tpl->mod = (count($list_mod)?$list_mod:array());
		defined("UGROUP") || define("UGROUP", $bauth->ugId);
  }

	$bmod->disconnect();

	$tpl->display('pundiamal-main.tpl.php');

} else {

	$tpl->display('login.tpl.php');

}

// end
$bauth->disconnect();
?>
