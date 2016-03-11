<?php
    /**
    * created 2007-05-26
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
    $keysearch = isset($_GET["keysearch"]) ? $_GET["keysearch"] : ''
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

function addSelectedItemsToParent() {
self.opener.addToParentList(window.document.myForm.destList);
window.close();
}
// Fill the selcted item list with the items already present in parent.

////////////////////////////////////////////////////////////////////////////
function fillInitialDestList() {
var destList = window.document.forms[1].destList;
var srcList = self.opener.window.document.forms[1].elements['s_player[]'];
for (var count = destList.options.length - 1; count >= 0; count--) {
destList.options[count] = null;
}
for(var i = 0; i < srcList.options.length; i++) {
if (srcList.options[i] != null)
destList.options[i] = new Option(srcList.options[i].text,srcList.options[i].value);
   }
}
// Add the selected items from the source to destination list

function addSrcToDestList() {
destList = window.document.forms[1].destList;
srcList = window.document.forms[1].srcList;
var len = destList.length;
for(var i = 0; i < srcList.length; i++) {
if ((srcList.options[i] != null) && (srcList.options[i].selected)) {
//Check if this value already exist in the destList or not
//if not then add it otherwise do not add it.
var found = false;
for(var count = 0; count < len; count++) {
if (destList.options[count] != null) {
if (srcList.options[i].text == destList.options[count].text) {
found = true;
break;
      }
   }
}
if (found != true) {
destList.options[len] = new Option(srcList.options[i].text,srcList.options[i].value);
len++;
         }
      }
   }
}
// Deletes from the destination list.
function deleteFromDestList() {
var destList  = window.document.forms[1].destList;
var len = destList.options.length;
for(var i = (len-1); i >= 0; i--) {
if ((destList.options[i] != null) && (destList.options[i].selected == true)) {
destList.options[i] = null;
      }
   }
}
</script>
</head>
<body link="#0000FF" vlink="#0000FF" alink="#FF0000">

<? if(!$bauth->checkSession() && URIGHT): ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td class="tbl_font">
<fieldset class="tbl_font"><legend class="tbl_font">Pop Up Assets</legend>
<form action="<?=$_SERVER['PHP_SELF']?>" method="get">
<table width="100%" border="0">
<tr>
	<td class="tbl_font">Search</td>
	<td class="tbl_font">:
		<input type="text" name="keysearch" size="15" class="fieldsearch" value="<?=$keysearch?>">
		<input type="submit" class="form_button" value="Search">
        <input type="hidden" name="s_id" value="<?=$_GET["s_id"]?>">
        <input type="hidden" name="t_id" value="<?=$_GET["t_id"]?>">
        <input type="hidden" name="c_id" value="<?=$_GET["c_id"]?>">
		<input type="hidden" name="act" value="search">
		<input type="hidden" name="idFrm" value="<?=$_GET["idFrm"]?>">
		<input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
		<input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
		[<a href="<?$_SERVER['PHP_SELF']?>?idFrm=<?=$_GET["idFrm"]?>&idField=<?=$_GET["idField"]?>&mod=<?=$_GET["mod"]?>&s_id=<?=$_GET["s_id"]?>&t_id=<?=$_GET["t_id"]?>&c_id=<?=$_GET["c_id"]?>">list</a>]
        [<a href="javascript:parent.window.close()">Close</a>]
</td></tr>
</table>
</form>
<hr size="1">

<?php
// player source
require_once MOD_DIR.'bola/bola-player.lib.php';
$bcms = new LBolaPlayer();
$data = $bcms->getPlayerList($keysearch,null);
$bcms->disconnect();

// squad player
if(isset($_GET["s_id"]) && isset($_GET["t_id"]) && isset($_GET["c_id"])):

	require_once MOD_DIR.'bola/bola-squad.lib.php';
	$bcms = new LBolaSquad();
	$dataSquadPlayer = $bcms->getSquadPlayer($_GET["s_id"], $_GET["t_id"], $_GET["c_id"]);
	$bcms->disconnect();

endif;
?>
<table width="100%" border="0" cellpadding="1" cellspacing="2" >
<tr>
	<td align="center" class='tbl_font' bgcolor="#CCCCCC">

  <div align="center">
  <center>
    <!-- TEST DUAL LIST -->
    <form action="" method="POST" name="myForm">
    <table border="0">
    <tr>
        <td>
            <select multiple size="18" style="width:250" name="srcList">
			<? foreach($data as $k => $v): ?>
				<option value="<?=$v["id"]?>"> <?=$v["p_name"]?> </option>
			<? endforeach; ?>
            </select>
        </td>
        <td>
          	<NOBR>
            <input type="button" class="form_button" value=" >> " onClick="javascript:addSrcToDestList()">
			<BR><NOBR>
            <input type="button" class="form_button" value=" << " onClick="javascript:deleteFromDestList();">
            <BR></NOBR>
        </td>
        <td>
            <select multiple size="18" style="width:250" name="destList">
            <? foreach($dataSquadPlayer as $k => $v): ?>
                <option value="<?=$v["s_player"]?>"> <?=$v["p_name"]?> </option>
            <? endforeach; ?>
            </select>
          </td>
        </tr>
      </table>
      <input type="button" value="Done" onClick = "javascript:addSelectedItemsToParent()">
    </form>
  </center>
	</div>

	</td>
</tr>
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
