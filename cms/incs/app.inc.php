<?php

require_once PEAR_DIR.'MDB2.php';
require_once PEAR_DIR.'Savant2.php';
require_once INC_DIR.'auth.lib.php';

if (!empty($_GET['mod'])) {
    $module = $_GET['mod'];
} elseif ($_SERVER['SCRIPT_NAME'] == '/login.php') {
    $module = 'login';
} else {
    $module = 'index';
}

defined("MODULE") or define("MODULE", $module);

$tpl = new Savant2();
$tpl->addPath('template', TPL_DIR.'webadmin/');

$tpl->act  = !empty($_REQUEST["act"]) ? $_REQUEST["act"] :"view";
$tpl->page = !empty($_REQUEST["page"])? $_REQUEST["page"]: 1;

$bauth = new Auth();

if (!empty($_SESSION['login'])) {
    if(MODULE != "login"){
        // check session
        $temp_sess = $bauth->checkSession();
        if ($temp_sess == 1) {
            $_SESSION["last_url"] = $_SERVER['REQUEST_URI'];
            header("Location: ".CMS_URL."?act=logout&type=1");
        } else if($temp_sess == 2) {
            $_SESSION["last_url"] = $_SERVER['REQUEST_URI'];
            header("Location: ".CMS_URL."?act=logout&type=2");
        }

        $uright = 0;
        // check auth
        if($_SESSION["login"] == "admin"){
            $uright = 1;
            define("UGROUP", 1);
        } else {
            if(!$bauth->checkAuth(MODULE,$tpl->act)) $uright = 0;
            else $uright = 1;

            define("UGROUP", $bauth->ugId);
        }
        define("URIGHT", $uright,true);
        $tpl->auth = $bauth->getAuth(MODULE);
    }
} else {
    header("Location: ".CMS_URL."logout.php");
}
