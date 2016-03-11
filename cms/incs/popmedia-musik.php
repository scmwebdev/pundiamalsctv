<?
	/**
	 * created 2008-06-26
	 * by asep.aiw
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

	$_act 	   = isset($_GET["act"])?$_GET["act"]:"";
	$_page     = isset($_GET["page"])?$_GET["page"]:"1";
	$keysearch = isset($_GET["keysearch"]) ? $_GET["keysearch"] : '';
	$fldsearch = isset($_GET["fldsearch"]) ? $_GET["fldsearch"] : '';
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
    	<tr>
        	<td class="tbl_font">
    			<fieldset class="tbl_font"><legend class="tbl_font">Pop Up Image Explorer</legend>
                    <table width="100%" border="0">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                        <tr><td class="tbl_font">Search</td>
                        <td class="tbl_font">:
                        <input type="text" name="keysearch" size="15" class="fieldsearch">
                        <?
                        require_once MOD_DIR.'musik-media.lib.php';
                        $bcms 	= new Media();
                        $field 	= $bcms->getField();
                        ?>
                        <select name="fldsearch" class="fieldsearch">
                        <option value="">--Select--</option>
                        <?
                        foreach($field as $k => $v){
                        echo '<option value="'.$k.'">'.$v.'</option>';
                        }
                        ?>
                        </select>
                        <input type="submit" class="forbutton" value="Search">
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

					$data 		= $bcms->getListData(0,$keysearch,$fldsearch,$_page);
					$totRec 	= $bcms->totRec;
					$makeUrl 	= $_SERVER['PHP_SELF']."?idFrm=".@$_GET["idFrm"]."&idField=".@$_GET["idField"]."&mod=".@$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
					$pagging 	= getPagging($makeUrl,$_page,$totRec);
					?>
                    <strong>Page:</strong> <?=$pagging?><br />
                    <table width="100%" border="0" cellpadding="1" cellspacing="2" >
                    <tr>
                    <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Picture</strong></td>
                    <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Type</strong></td>
                    <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Caption</strong></td>
                    <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Keyword</strong></td>
                    </tr>
                    <?
                    $arrType = array('pic' => 'Picture', 'tpic' => 'Thumbnail Picture', 'aud' => 'Audio (General)', 'vid' => 'Video (General)', 'wacp' => 'Web Audio Clip (Preview) - MP3/WMA', 'wacf' => 'Web Audio Clip (Full Version) - MP3/WMA', 'wvcp' => 'Web Video Clip (Preview) - FLV', 'wvcf' => 'Web Video Clip (Full Version) - FLV', 'mvc' => 'Mobile Video Clip - 3GP', 'mrbt' => 'Mobile Ring Back Tone', 'mrt' => 'Mobile Ring Tone - MP3/WMA');
                    $ii	= 0;
                    foreach($data as $k => $v){
                    	$ii++;
                    	if($ii % 2 == 0)
							echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\" rowspan='3'>";
                    	else
							echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\" rowspan='3'>";
                    		echo "<td class='tbl_font' rowspan='3' align='center'>";

							switch ($v["type"]) {
								case "aud"	:
								case "wacp" :
								case "wacf" :
								case "mrbt" :
								case "mrt"	:
									echo '[<a href="'.MEDIA_LIPUTAN6.$v['location'].'">audio</a>]';
									break;
								case "vid"	:
								case "wvcp"	:
								case "wvcf" :
									echo '[<a href="'.MEDIA_LIPUTAN6.$v['location'].'">video</a>]';
									break;
								default			:
									echo '<img src="'.MEDIA_LIPUTAN6.$v['location'].'" alt=" " border="0" width="57" />';
							}

                    echo "</td>";
                    echo "<td align='center' class='tbl_font'>".$arrType[$v["type"]]."</td>";
                    echo "<td class='tbl_font'>".$v["caption"]."</td>";
                    echo "<td class='tbl_font'>".$v["keyword"]."</td></tr>";

                    if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\" rowspan='2'>";
                    else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\" rowspan='2'>";

                    if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\" rowspan='2'>";
                    else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\" rowspan='2'>";
                    echo "<td class='tbl_font' colspan='3'><strong>Image String:</strong> <input type='text' value='|image=".$v["id"]."|' class='fieldsearch'/>";
                    echo " [<a href=\"javascript:sendStr('".$v["id"]."','".$_GET["idField"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
                    echo "</td></tr>";
                    }
                    ?>
                    </table>
   					<strong>Page:</strong> <?=$pagging?>
    			</fieldset>
    		</td>
    	<tr>
    	</table>

    <? else: ?>

        Sorry. You can't access the page.<br/>
        Please, Contact your administrator...

	<? endif; ?>

</body>
</html>
