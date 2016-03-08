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
    function sendStr(aString,aString2,aField,aField2,aFrm){
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
                <fieldset class="tbl_font"><legend class="tbl_font">Pop Up News Explorer</legend>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
                        <table width="100%" border="0">
                            <tr>
                                <td class="tbl_font">Search</td>
                                <td class="tbl_font">:
                                    <input type="text" name="keysearch" size="15" class="fieldsearch" value="<?=$keysearch?>">
                                    <?
                                    require_once MOD_DIR.'popnews-lip6.lib.php';
                                    $bcms     = new PopNews();
                                    $field     = $bcms->getField();
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
                                    <input type="hidden" name="act" value="search">
                                    <input type="hidden" name="idFrm"     value="<?=$_GET["idFrm"]?>">
                                    <input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
                                    <input type="hidden" name="idField2" value="<?=$_GET["idField2"]?>">
                                    <input type="hidden" name="mod" value="<?=$_GET["mod"]?>">
                                    [<a href="<?$_SERVER['PHP_SELF']?>?idFrm=<?=$_GET["idFrm"]?>&idField=<?=$_GET["idField"]?>&idField2=<?=$_GET["idField2"]?>&mod=<?=$_GET["mod"]?>">list</a>]
                                </td>
                                <td class="tbl_font" align="right">
                                    [<a href="javascript:parent.window.close()">Close</a>]
                                </td>
                            </tr>
                        </table>
                    </form>
                    <hr size="1">
                    <?
                    $data         = $bcms->getListData(0,$keysearch,$fldsearch,$_page,1);
                    $totRec     = $bcms->totRec;
                    $makeUrl     = $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&idField2=".$_GET["idField2"]."&idField3=".$_GET["idField3"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
                    $pagging     = getPagging($makeUrl,$_page,$totRec);
                    ?>
                    <strong>Page:</strong> <?=$pagging?><br />
                    <table width="100%" border="0" cellpadding="1" cellspacing="2" >
                        <tr>
                            <td  align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>M PCITURE</strong></td>
                            <td  align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>ID NEWS</strong></td>
                            <td  align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>TITLE</strong></td>
                            <td  align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>LINK</strong></td>
                            <td  align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>PATH M PICTURE</strong></td>
                            <td  align="center" class='tbl_font' bgcolor="#CCCCCC" width="40px">&nbsp;</td>
                        </tr>
                        <?
                        $ii = 0;
                        foreach ($data as $k => $v) {
                            $ii++;
                            if ($ii % 2 == 0) :?>
                                <tr class="out" onmouseover="this.className = 'over';" onmouseout="this.className = 'out';">
                            <?    else : ?>
                                <tr class="out2" onmouseover="this.className = 'over';" onmouseout="this.className = 'out2';">
                            <?php endif; ?>
                                <td class='tbl_font' ><img src="<?=($v["mpicid"]>0?MEDIA_LIPUTAN6.$bcms->getThumbnail($v["mpicid"]):"/tpls/webadmin/images/noimage.jpg")?>" width="50px"></td>
                                <td class='tbl_font' valign="top">
                                    <span style='color:#FF0000; font-weight:bold'><?=$v["id"]?></span>
                                </td>
                                <td class='tbl_font' ><?=html_entity_decode($v["title"])?></td>
                                <td class='tbl_font' ><?=$v["link"]?></td>
                                <td class='tbl_font' ><?=($v["mpicid"]>0?MEDIA_LIPUTAN6.$bcms->getThumbnail($v["mpicid"]):"")?></td>
                                <td class='tbl_font'>
                                    [ <a href="javascript:sendStr('<?=$v["id"]?>','<?=$v["title"]?>','<?=$_GET["idField"]?>','<?=$_GET["idField2"]?>','<?=$_GET["idFrm"]?>')"><span style='color:#0000FF; font-weight:bold'>Pick</span></a> ]
                                </td>
                            </tr>
                        <?
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
