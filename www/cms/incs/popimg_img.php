<?
	/**
	 * created 2003-10-30 
	 * updated 2006-08-22
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language=JavaScript>
function sendStr(aString,aField,aFrm){
	eval('top.opener.document.'+aFrm+'.'+aField+'.value = "'+aString+'"');
	parent.window.close();
}
</script>
<link href="popimg.css" rel="stylesheet" type="text/css">
</head>
<body link="#0000FF" vlink="#0000FF" alink="#FF0000" class="tbl_font">

<? if(!$bauth->checkSession() && URIGHT): ?>

<?
if(!empty($_GET["img"])){

	echo "<img src='".$_GET["img"]."' width='150'><br><br>";
	//echo "Filename: <br><b>".basename($_GET["img"])."</b><br>";
	$filename = substr($_GET["img"],strpos($_GET["img"],"//")+2,strlen($_GET["img"]));
	$filename = substr($filename,strpos($filename,"/"),strlen($filename));
	echo "Filename: <br><b>".$filename."</b><br>";
?>
<a href="javascript:sendStr('<?=$filename?>','<?=$_GET["idField"]?>','<?=$_GET["idFrm"]?>')">Pick File</a><br>
<a href="javascript:parent.window.close()">Close</a>
<?
}
?>

<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>

</body>
</html>