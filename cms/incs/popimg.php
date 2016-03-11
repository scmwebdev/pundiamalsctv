<?
	/**
	 * created 2003-10-30 
	 * updated 2006-11-25
	 * by bonny.hp@gmail.com 
	 */
	 session_start();
	 require_once("config.inc.php");
	 session_cache_expire(SESS_TIME/3600);
	 session_name("bcms-sess");
	 require_once PEAR_DIR.'MDB2.php';
	 require_once INC_DIR.'auth.lib.php';
	 
	 
	 $bauth = new Auth();
	 $bauth->checkSession();

	 	// check auth
		if(!empty($_SESSION["login"]) && $_SESSION["login"] == "admin") define("URIGHT", 1);
		else {
			if(!$bauth->checkAuth(@$_REQUEST["mod"],"add")) define("URIGHT", 0);
			else define("URIGHT", 1);
		}
?>
<html>
<head>
  <title>POPUP IMAGE :: bcms@v.4</title>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<? if(!$bauth->checkSession() && URIGHT): ?>
<frameset cols="200,*" frameborder="1">
	<frame name="frm_img" src="popimg_img.php" scrolling="yes">
	<frame name="frm_nav" src="popimg_nav.php?idFrm=<?=$_GET["idFrm"]?>&idField=<?=$_GET["idField"]?>&mod=<?=$_REQUEST["mod"]?>" scrolling="yes">
</frameset>
<noframes>
<body>
Please Upgrade your browser.<br>
Your browser doesn't support frame...
</body>
</noframes>
<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>
</html>