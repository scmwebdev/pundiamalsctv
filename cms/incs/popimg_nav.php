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

$_act = (isset($_GET["act"])?$_GET["act"]:"");

$rb = FILE_DIR; // real path
$ri = FILE_URL; // web path
$p = (isset($_GET["p"])?$_GET["p"]:"");

if(empty($p)){
	$b = $rb; $i = $ri;
} else {
	$b = $rb.$p."/"; $i = $ri.$p."/";
}
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="popimg.css" rel="stylesheet" type="text/css">
</head>
<body link="#0000FF" vlink="#0000FF" alink="#FF0000">

<? if(!$bauth->checkSession() && URIGHT): ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td class="tbl_font">
<fieldset class="tbl_font"><legend class="tbl_font">Pop Up Image Explorer</legend>
<table width="100%" border="0">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
	<tr><td class="tbl_font" width="70">Make Direktori</td>
		<td class="tbl_font">: 
				<input type="text" name="dirname" size="15" class="fieldsearch">
				<input type="submit" class="form_button" value="Make">
        <input type="hidden" name="p" value="<?=$p?>">
				<input type="hidden" name="act" value="mkdir">
				<input type="hidden" name="idFrm" value="<?=$_GET["idFrm"]?>">
				<input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
				<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
		</td></tr>
	</form>
	<form method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>?act=upl&p=<?=$p?>&idFrm=<?=$_GET["idFrm"]?>&idField=<?=$_GET["idField"]?>&mod=<?=$_GET["mod"]?>">
		<tr><td class="tbl_font">Upload</td>
			<td class="tbl_font">: 
				<input name="file" type="file" class="form_button" size="15">
				<input type="submit" class="form_button" value="Upload">
		</td></tr>
	</form>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
	<tr><td class="tbl_font">Search</td>
		<td class="tbl_font">: 
			<input type="text" name="keysearch" size="15" class="fieldsearch">
				<input type="submit" class="form_button" value="Search">
        <input type="hidden" name="p" value="<?=$p?>">
				<input type="hidden" name="act" value="search">
				<input type="hidden" name="idFrm" value="<?=$_GET["idFrm"]?>">
				<input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
				<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
				[<a href="<?$_SERVER['PHP_SELF']?>?idFrm=<?=$_GET["idFrm"]?>&idField=<?=$_GET["idField"]?>&mod=<?=$_GET["mod"]?>">list</a>]
	</td></tr>
	</form>
</table>
<hr size="1">
<?
// action
switch($_act){
	case "del":
		if(@unlink($b.$_GET["img"]) == "0")
			echo "File couldn't be deleted ..!<br>";
		else
			echo "File <b>".basename($_GET["img"])."</b> has been deleted ..!<br>";
		break;
	case "deldir":
		if(@rmdir($b."/".$_GET["img"]) == "0")
			echo "Directory couldn't be deleted ..!<br>";
		else
			echo "Directory <b>".basename($_GET["img"])."</b> has been deleted ..!<br>";
		break;
	case "mkdir":
		if(@mkdir ($b."/".$_GET["dirname"],0700) == "1")
			echo "Directory <b>".$_GET["dirname"]."</b> has been created ..!<br>";
		else
			echo "Directory couldn't be created ..!<br>";
		break;
	case "upl":
		if (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'])) {
			$s_old = $HTTP_POST_FILES['file']['tmp_name'];
			$s_new = $b."/".strtolower($HTTP_POST_FILES['file']['name']);
			@move_uploaded_file($s_old, $s_new);
			echo "File ".strtolower($HTTP_POST_FILES['file']['name'])." has been uploaded ..!<br>";
		} else
			echo "File couldn't be uploaded ..!";
		break;
	case "search":
		$keysearch = $_GET["keysearch"];
		break;
}

?>
<table width="100%" border="0" cellpadding="1" cellspacing="2" >
<tr>
	<td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Name</strong></td>
	<td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Size</strong></td>
	<td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Pick</strong></td>
	<td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Del </strong></td>
</tr>	
<?
// buat search
function search($var){
	global $keysearch;
	if(strpos($var, $keysearch) === false) return 0;
	else return 1;
}

chdir($b);
$dir = opendir(".");
$adir = array(); $afile = array();
while($file=readdir($dir)){
	if(filetype($file) == "dir") array_push($adir, $file);
	else array_push($afile, $file);
}

// buat search
if($_act == "search" && !empty($keysearch)){
	$adir = array_filter($adir,"search");
	$afile = array_filter($afile,"search");
}

// print 
sort($adir); sort($afile); $ii=0;
foreach($adir as $val){
	if($val != "."){
		$ii++;
		if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
		else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
		
		if($val == ".."){
			echo "<td colspan='4' class='tbl_font'>";
			if(!empty($p))
				echo "<a href='".$_SERVER["PHP_SELF"]."?p=".substr($p,0,strrpos($p,"/"))."&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."'>$val</a>";
			echo "</td>";
		} else {
			if(empty($p))
				echo "<td class='tbl_font' colspan='3'><a href='".$_SERVER["PHP_SELF"]."?p=$val&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."'><strong>$val</strong></a></td>";
			else
				echo "<td class='tbl_font' colspan='3'><a href='".$_SERVER["PHP_SELF"]."?p=".$p."/".$val."&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."'><strong>$val</strong></a></td>";
		 
		  // cek auth
		  if($bauth->checkAuth(@$_REQUEST["mod"],"del")  || $_SESSION['login']=="admin")			
		    echo "<td class='tbl_font' align='center'><a href='".$_SERVER["PHP_SELF"]."?act=deldir&img=".$val."&p=$p&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."'>del</a></td></tr>";
		  else
		    echo "<td class='tbl_font' align='center'>&nbsp;</td></tr>";
		}
	}
}
foreach($afile as $val){
		$ii++;
		if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
		else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
		echo "<td class='tbl_font'>$val</td>";
		echo "<td align='right' class='tbl_font'>".filesize($val)." b</td>";
		echo "<td class='tbl_font' align='center'><a href='popimg_img.php?img=".$i.$val."&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."' target='frm_img'>pick</a></td>";
		if($bauth->checkAuth(@$_REQUEST["mod"],"del") || $_SESSION['login']=="admin")
		  echo "<td class='tbl_font' align='center'><a href='".$_SERVER["PHP_SELF"]."?act=del&img=".$val."&p=$p&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."'>del</a></td></tr>";
    else
      echo "<td class='tbl_font' align='center'>&nbsp;</td></tr>";
}

?>
</table>
</fieldset>
</td><tr>
</table>

<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>

</body>
</html>
