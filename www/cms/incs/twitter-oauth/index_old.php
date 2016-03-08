<?
/**
	 * created 2010-Nov-11
	 * by wibawa.priatama@sctv.co.id 
	 */
	 session_start();
	 require_once("../config.inc.php");
	 require_once("../function.inc.php");
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

<? if(!$bauth->checkSession() && URIGHT): ?>

<?
require_once MOD_DIR.'l6-news.lib.php';
$bcms = new L6News();

$bcms->twitterData($_REQUEST["id"],$_REQUEST["twitter_status"]);
?>

<?
if($_REQUEST["title_to_twitter"]){
echo "Tweet sukses ";
echo "<br>";
//echo $_REQUEST["twitter_status"];
}else{
echo " GAGAL ";
}
?>

<script type="text/javascript">

	function tutupRefresh() {
		opener.location.reload();
		window.close();
	}
	
</script>

<!-- <a href="javascript:opener.location.reload();">Reload Page A</a> -->
<br>
<input class="pub" name="close" type="button" value="Close" onClick="tutupRefresh()"/>



<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>