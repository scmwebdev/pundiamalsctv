<?php
    session_start();
    require_once("config.inc.php");
    require_once("function.inc.php");
    session_cache_expire(SESS_TIME/3600);
    session_name("bcms-sess");
    require_once PEAR_DIR.'MDB2.php';
    require_once MOD_DIR.'popnews-lip6-facelift.lib.php';
    $bcms      = new PopNews();
    $_act      = (isset($_GET["act"])?$_GET["act"]:"");
    $_page     = (isset($_GET["page"])?$_GET["page"]:"1");
    $keysearch = (isset($_GET["keysearch"])?$_GET["keysearch"]:"");
    $fldsearch = (isset($_GET["fldsearch"])?$_GET["fldsearch"]:"");
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="popimg.css" rel="stylesheet" type="text/css">
    <script language=JavaScript>
    function sendStr(aString,aString2,aField,aField2,aFrm){
    eval('top.opener.document.'+aFrm+'.'+aField+'.value = "'+aString+'"');
    eval('top.opener.document.'+aFrm+'.'+aField2+'.value = "'+aString2+'"');
    parent.window.close();
    }
    </script>
</head>
<body bgcolor="#6699FF" link="#0000FF" vlink="#0000FF" alink="#FF0000">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td class="tbl_font">
            <fieldset class="tbl_font">
                <legend class="tbl_font">Pop Up <b>News Url</b> Explorer</legend>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                    <table width="100%" border="0">
                        <tr>
                            <td class="tbl_font">Search</td>
                            <td class="tbl_font">:
                                <input type="text" name="keysearch"  style="width:140px" class="fieldsearch" value="<?=$keysearch?>">
                                <?
                                $field = $bcms->getField();
                                ?>
                                <select name="fldsearch" class="fieldsearch">
                                <option value="">--Select--</option>
                                <?
                                foreach($field as $k => $v){
                                echo '<option value="'.$k.'" '.($k==$fldsearch?" selected ":"").'>'.$v.'</option>';
                                }
                                ?>
                                </select>
                                <input type="submit" class="form_button" value="Display">
                                <input type="hidden" name="act"     value="search">
                                <input type="hidden" name="idFrm"   value="<?=$_GET["idFrm"]?>">
                                <input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
                                <input type="hidden" name="idField2" value="<?=$_GET["idField2"]?>">
                                <input type="hidden" name="mod"     value="<?=$_GET["mod"]?>">
                            </td>
                        </tr>
                    </table>
                </form>
                <hr size="1">
                <?
                switch($_act){
                    case "search":
                    $keysearch = $_GET["keysearch"];
                    $fldsearch = $_GET["fldsearch"];
                    break;
                }
                
                $data        = $bcms->selectData(0,$keysearch,$fldsearch,$_page,1);
                $totRec      = $bcms->totRec;
                $makeUrl     = $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&idField2=".$_GET["idField2"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
                $pagging     = getPagging($makeUrl,$_page,$totRec);
                ?>
                <strong>Page:</strong> <?=$pagging?><br />
                <table width="100%" border="0" cellpadding="1" cellspacing="2" >
                    <tr>
                        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Channel Domain</strong></td>
                        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>News Title</strong></td>
                        <td align="center" class='tbl_font' bgcolor="#CCCCCC" style="width: 50px"><strong>&nbsp;</strong></td>
                    </tr>
                    <? $ii=0;
                    foreach($data as $k => $v){
                            $ii++;
                            if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
                            else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
                            echo "<td class='tbl_font'>".$v["channel_domain"]."</td>";
                            echo "<td class='tbl_font'>".$v["title"]."</td>";
                            echo "<td class='tbl_font' style='text-align:center'>";
                            echo " [<a href=\"javascript:sendStr('".$v["id"]."','".$v["link"]."','".$_GET["idField"]."','".$_GET["idField2"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
                            echo "</td></tr>";
                    } ?>
                </table>
                <strong>Page:</strong> <?=$pagging?>
            </fieldset>
        </td>
    <tr>
</table>
</body>
</html>