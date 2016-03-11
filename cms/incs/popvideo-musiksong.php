<?
	session_start();
	require_once("config.inc.php");
	require_once("function.inc.php");
	session_cache_expire(SESS_TIME/3600);
	session_name("bcms-sess");
	require_once PEAR_DIR.'MDB2.php';
	require_once INC_DIR.'auth.lib.php';
	$bauth 		= new Auth();
	require_once MOD_DIR.'musik-song.lib.php';
    $bcms 		= new Song();
	
	$bauth->checkSession();
	if(!empty($_SESSION["login"]) && $_SESSION["login"] == "admin") define("URIGHT", 1);
	else {
	if(!$bauth->checkAuth(@$_REQUEST["mod"],"add")) define("URIGHT", 0);
	else define("URIGHT", 1);
	}
	$_act 	= (isset($_GET["act"])?$_GET["act"]:"");
	$_page 	= (isset($_GET["page"])?$_GET["page"]:"1");
	$c_id 	= (isset($_GET["kategori"])?$_GET["kategori"]:"");
	$tgl 	= (isset($_GET["tanggal"])?$_GET["tanggal"]:"");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="popimg.css" rel="stylesheet" type="text/css">
<script language=JavaScript>
function sendStr(aString,aString2,aString3,aField,aField2,aField3,aFrm){
eval('top.opener.document.'+aFrm+'.'+aField+'.value = "'+aString+'"');
eval('top.opener.document.'+aFrm+'.'+aField2+'.value = "'+aString2+'"');
eval('top.opener.document.'+aFrm+'.'+aField3+'.value = "'+aString3+'"');
parent.window.close();
}
</script>
</head>
<body bgcolor="#99CC99" link="#0000FF" vlink="#0000FF" alink="#FF0000">
	<? if(!$bauth->checkSession() && URIGHT): ?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr><td class="tbl_font">
    <fieldset class="tbl_font"><legend class="tbl_font"><b>Inbox Music Song</b> Explorer</legend>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
        <table width="100%" border="0">
			<? /*   
			<tr>
            	<td class="tbl_font">Category</td>
                <td class="tbl_font">: 
                    <?  $listkategori 	= $bcms->selectKategori();?>
                    <select style="width:140px" name="kategori" class="fieldsearch" >
                    <?
                    foreach($listkategori as $k => $v){
                    echo '<option value="'.$v['cat_id'].'" '.($c_id==$v['cat_id']?" selected ":"").'>'.$v['cat_name'].'</option>';
                    }
                    echo "<option value='' ".($c_id==''?" selected ":"").">-- All Category --</option>";
					?>        
                    </select>
                </td>
                <td class="tbl_font" align="right">
                </td>
            </tr>
			
            <tr><td class="tbl_font">Publishdate</td>
                <td class="tbl_font">:
                    <input style="width:140px" type="text" name="tanggal" id="tanggal" style="width:110px" value="<?=($tgl?$tgl:"")?>" class="fieldsearch"/> 
					<button id="trigger_tanggal">...</button> (yyyy-mm-dd)
                </td>
                <td class="tbl_font" align="right">
                </td>
            </tr>
			   */ ?>
            <tr>
            	<td class="tbl_font">Search</td>
                <td class="tbl_font">: 
                    <input type="text" name="keysearch"  style="width:140px" class="fieldsearch">
                    <select name="fldsearch" class="fieldsearch">
                    <option value="">--Select--</option>
					<option value="d.song_id">Song ID</option>
					<option value="d.song_title">Title</option>
					<option value="a.artist_name">Artist</option>   
                    </select>
                    <input type="submit" class="form_button" value="Display">
                    <input type="hidden" name="act" 	value="search">
                    <input type="hidden" name="idFrm" 	value="<?=$_GET["idFrm"]?>">
                    <input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
                    <input type="hidden" name="idField2" value="<?=$_GET["idField2"]?>">
                    <input type="hidden" name="idField3" value="<?=$_GET["idField3"]?>">
                    <input type="hidden" name="mod" 	value="<?=$_GET["mod"]?>">
                </td>
            </tr>	
        </table>
    </form>
	<? /*
    <style type="text/css">@import url(<?=LIB_URL?>jscalendar/calendar-win2k-1.css);</style>
	<script type="text/javascript" src="<?=LIB_URL?>jscalendar/calendar.js"></script>
    <script type="text/javascript" src="<?=LIB_URL?>jscalendar/lang/calendar-en.js"></script>
    <script type="text/javascript" src="<?=LIB_URL?>jscalendar/calendar-setup.js"></script>
    <script type="text/javascript">
        Calendar.setup(
        {
        inputField  : "tanggal",
        ifFormat    : "%Y-%m-%d",
                showsTime		: true,
        button      : "trigger_tanggal"
        }
        );
        
    </script>
	   */ ?>
    <hr size="1">
    <?
    switch($_act){
	case "search":
	$keysearch = $_GET["keysearch"];
	$fldsearch = $_GET["fldsearch"];
	break;
	}
    
	$data 		= $bcms->selectVideoSongInbox($keysearch,$fldsearch,$_page);

    $totRec 	= $bcms->totRec;
    $makeUrl 	= $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&idField2=".$_GET["idField2"]."&idField3=".$_GET["idField3"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
    $pagging 	= getPagging($makeUrl,$_page,$totRec);
    ?>
    <strong>Page:</strong> <?=$pagging?><br />
    <table width="100%" border="0" cellpadding="1" cellspacing="2" >
    <tr>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC" style="width:10%;"><strong>Thumbnail</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC" style="width:10%;"><strong>Song ID</strong></td>
		<td align="center" class='tbl_font' bgcolor="#CCCCCC" style="width:35%;"><strong>Artist</strong></td>
		<td align="center" class='tbl_font' bgcolor="#CCCCCC" style="width:35%;"><strong>Title</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC" style="width:10%;"><strong>&nbsp;</strong></td>
    </tr>	
    <?
    $ii=0;
    foreach($data as $k => $v){
            $ii++;
            if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
            else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";          
            echo "<td class='tbl_font'><img width='80' height='50' src=".($bcms->getThumbnail($v["tvpic_id"])?MEDIA_LIPUTAN6.$bcms->getThumbnail($v["tvpic_id"]):TPL_URL."webadmin/images/noimage.jpg")."></td>";
            echo "<td class='tbl_font' align='center'><strong>[<a href=".VIDEO_LIPUTAN6.$v['cat_id']."/".$v['song_id'].">".$v["song_id"]."</a>]</strong></td>";
			echo "<td class='tbl_font'>".$v["artist_name"]."</td>";
			echo "<td class='tbl_font'>".$v["song_title"]."</td>";
            echo "<td class='tbl_font' style='text-align:center'>";
            echo " [<a href=\"javascript:sendStr('".$v["song_id"]."','".$v["artist_name"]."','".$v["song_title"]."','".$_GET["idField"]."','".$_GET["idField2"]."','".$_GET["idField3"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
            echo "</td></tr>";
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
