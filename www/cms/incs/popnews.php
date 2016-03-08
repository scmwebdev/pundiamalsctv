<?
	/**
	 * created 2007-07-10
	 * by bonny.hp@gmail.com 
	 */
	 session_start();
	 require_once("config.inc.php");
	 require_once("function.inc.php");
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
		$_page = (isset($_GET["page"])?$_GET["page"]:"1");
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="popimg.css" rel="stylesheet" type="text/css">
	<script language=JavaScript>
	function sendStr(aString,aField,aFrm){
		eval('top.opener.document.'+aFrm+'.'+aField+'.value = "'+aString+'"');
		parent.window.close();
	}
	</script>
</head>
<body link="#0000FF" vlink="#0000FF" alink="#FF0000">

<? if(!$bauth->checkSession() && URIGHT): ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td class="tbl_font">
<fieldset class="tbl_font"><legend class="tbl_font">Pop Up News Explorer</legend>
<table width="100%" border="0">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
	<tr><td class="tbl_font">Search</td>
		<td class="tbl_font">: 
				<input type="text" name="keysearch" size="15" class="fieldsearch">
<?
require_once MOD_DIR.'popnews.lib.php';
$bcms = new PopNews();
$field = $bcms->getField();
?>
				<select name="fldsearch" class="fieldsearch">
        	<option value="">--Select--</option>
<?
foreach($field as $k => $v){
	echo '<option value="'.$k.'">'.$v.'</option>';
}
?>        
				</select>
        <input type="submit" class="form_button" value="Search">
				<input type="hidden" name="act" value="search">
				<input type="hidden" name="idFrm" value="<?=$_GET["idFrm"]?>">
				<input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
				<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
				[<a href="<?$_SERVER['PHP_SELF']?>?idFrm=<?=$_GET["idFrm"]?>&idField=<?=$_GET["idField"]?>&mod=<?=$_GET["mod"]?>">list</a>]
	</td>
  <td class="tbl_font" align="right">
  	[<a href="javascript:parent.window.close()">Close</a>]
  </td>
  </tr>
	</form>
</table>
<hr size="1">
<?
// action
switch($_act){
	case "search":
		$keysearch = $_GET["keysearch"];
		$fldsearch = $_GET["fldsearch"];
		break;
}

$channel = ($_REQUEST['idField'] == 'gosipID' ? '5' : '1,11');
$data = $bcms->getListData(0,$channel,$keysearch,$fldsearch,$_page,1);
$totRec = $bcms->totRec;
$makeUrl = $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
$pagging = getPagging($makeUrl,$_page,$totRec);
?>
<strong>Page:</strong> <?=$pagging?><br />
<table width="100%" border="0" cellpadding="1" cellspacing="2" >
<tr>
	<td width="5%" align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>ID</strong></td>
	<td width="8%" align="center" class='tbl_font' bgcolor="#CCCCCC">&nbsp;</td>
	<td width="77%" align="center" class='tbl_font' bgcolor="#CCCCCC"><strong><strong>Description</strong></td>
	<td width="10%" align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
</tr>
<?php
$ii = 0;
foreach ($data as $k => $v) {
	$ii++;
	if ($ii % 2 == 0) :
?>
		<tr class="out" onmouseover="this.className = 'over';" onmouseout="this.className = 'out';">
<?php	else : ?>
		<tr class="out2" onmouseover="this.className = 'over';" onmouseout="this.className = 'out2';">
<?php endif; ?>
			<td class='tbl_font' valign="top" rowspan="3"><span style='color:#FF0000; font-weight:bold'><?=$v["id"]?></span></td>
			<td class='tbl_font' style="text-align:right" ><strong>Title</strong></td>
			<td class='tbl_font' ><?=$v["title"]?></td>
			<td style='text-align:center'>
			[ <a href="javascript:sendStr('<?=$v["id"]?>','<?=$_GET["idField"]?>','<?=$_GET["idFrm"]?>')"><span style='color:#0000FF; font-weight:bold'>Pick</span></a> ]
			</td>
		</tr>
		<tr><td class='tbl_font' style="text-align:right" valign="top"><strong>Desc</strong></td><td class='tbl_font' ><?=$v["shortdesc"]?></td></tr>
		<tr><td class='tbl_font' style="text-align:right"><strong>Date</strong></td><td class='tbl_font'><?=$v["publish_date"]?></td></tr>
		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php 		
	}
?>
</table>
<strong>Page:</strong> <?=$pagging?>
</fieldset>
</td><tr>
</table>

<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>

</body>
</html>
