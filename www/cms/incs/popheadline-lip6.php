<?
    session_start();
    require_once("config.inc.php");
    require_once("function.inc.php");
    session_cache_expire(SESS_TIME/3600);
    session_name("bcms-sess");
    require_once PEAR_DIR.'MDB2.php';

    $_page     = (isset($_GET["page"])?$_GET["page"]:"1");
    $keysearch = ($_GET["keysearch"]?$_GET["keysearch"]:$_REQUEST["keysearch"]);
    $fldsearch = ($_GET["fldsearch"]?$_GET["fldsearch"]:$_REQUEST["fldsearch"]);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="popimg.css" rel="stylesheet" type="text/css">
    <script language=JavaScript>
    function sendStr(aString,aField,aString2,aField2,aFrm){
    eval('top.opener.document.'+aFrm+'.'+aField+'.value = "'+aString+'"');
    eval('top.opener.document.'+aFrm+'.'+aField2+'.value = "'+aString2+'"');
    parent.window.close();
    }
    </script>
</head>
<body link="#0000FF" vlink="#0000FF" alink="#FF0000">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td class="tbl_font">
                <fieldset class="tbl_font"><legend class="tbl_font">Pop Up News Headline Explorer</legend>
                    <table width="100%" border="0">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                            <tr>
                                <td class="tbl_font">Search</td>
                                <td class="tbl_font">: 
                                    <input type="text" name="keysearch" size="15" class="fieldsearch"  value="<?=$keysearch?>">
                                    <?
                                    require_once MOD_DIR.'l6-news.lib.php';
                                    $bcms = new L6News();                                
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
                                    <input type="submit" class="form_button" value="Search">
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
                    $data = $bcms->getListDataAll($id,$keysearch,$fldsearch,$c_id,$_page);
                    $totRec = $bcms->totRec;
                    
                    $makeUrl = $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&idField2=".$_GET["idField2"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
                    $pagging = getPagging($makeUrl,$_page,$totRec);
                    ?>
                    <strong>Page:</strong> <?=$pagging?><br />
                    <table width="100%" border="0" cellpadding="1" cellspacing="2" >
                        <tr>
                            <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>ID</strong></td>
                            <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Title</strong></td>
                            <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Short Desc</strong></td>
                            <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Pic ID</strong></td>
                            <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
                        </tr>    
                        <?
                        $ii=0;
                        foreach($data as $k => $v){
                            $ii++;
                            if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
                            else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
                            echo "<td class='tbl_font' align='center'>";
                            echo $v["id"];
                            echo "</td>";
                            echo "<td class='tbl_font'>".html_entity_decode($v["title"])."</td>";
                            echo "<td class='tbl_font'>".html_entity_decode($v["shortdesc"])."</td>";        
                            echo "<td class='tbl_font'>".$v["picid"]."</td>";        
                            echo "<td class='tbl_font' style='text-align:center'>";
                            echo " [<a href=\"javascript:sendStr('".$v["id"]."','".$_GET["idField"]."','".$v["link"]."','".$_GET["idField2"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
                            echo "</td></tr>";
                        }
                        ?>
                    </table>
                    <strong>Page:</strong> <?=$pagging?>
                </fieldset>
            </td>
        <tr>
    </table>
</body>
</html>
