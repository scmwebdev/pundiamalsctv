<?php
    /**
     * created 2007-05-14
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
    <link rel="stylesheet" type="text/css" href="<?=TPL_URL?>webadmin/css/pagging.css" />
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
<fieldset class="tbl_font"><legend class="tbl_font">Pop Up Image Explorer</legend>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
    <table width="100%" border="0">
    <tr><td class="tbl_font">Search</td>
        <td class="tbl_font">:
            <input type="text" name="keysearch" size="15" class="fieldsearch">
            <?
            require_once MOD_DIR.'bola/bola-media.lib.php';
            $bcms = new LBolaMedia();
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
    </table>
    </form>
    <hr size="1">

<?php
    $keysearch = isset($_GET["keysearch"]) ? $_GET["keysearch"] : '';
    $fldsearch = isset($_GET["fldsearch"]) ? $_GET["fldsearch"] : '';

    $data      = $bcms->getListData(0,$keysearch,$fldsearch,$_page);
    $totRec    = $bcms->totRec;
    $makeUrl   = $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&amp;idField=".$_GET["idField"]."&amp;mod=".$_GET["mod"];
    $makeUrl  .= "&amp;keysearch=".$keysearch."&amp;fldsearch=".$fldsearch;
    $pagging   = createPagging($makeUrl,$_page,$totRec);

    if($keysearch) echo '<strong>Search:</strong> '.$keysearch.'<br />';

?>

    <div><span style="float:left"><b>Page:</b></span>
        <?=$pagging?>
    </div>
    <table width="100%" border="0" cellpadding="1" cellspacing="2" >
    <tr>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Picture</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Type</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Caption</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Keyword</strong></td>
    </tr>
    <?
        $arrType = array('pic' => 'Picture', 'mtpic' => 'Middle Thumb', 'tpic' => 'Thumb', 'vid' => 'Video');
        $i=0;
        foreach($data as $k => $v){
            $i++;
            if($i % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\" rowspan='3'>";
            else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\" rowspan='3'>";
            echo "<td class='tbl_font' rowspan='2' align='center'>";
        if($v["type"] == "vid")
            echo " [<a href='".MEDIA_LIPUTAN6.$v["location"]."'>video</a>] ";
        else
            echo " <img src='".MEDIA_LIPUTAN6.$v["location"]."' width='57' /> ";
            echo "</td>";
            echo "<td align='center' class='tbl_font'>".@$arrType[$v["type"]]."</td>";
            echo "<td class='tbl_font'>".$v["caption"]."</td>";

            if($i % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\" rowspan='3'>";
            else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\" rowspan='3'>";
            echo "<td class='tbl_font' colspan='3'><strong>Image String:</strong> <input type='text' value='|image=".$v["id"]."|' class='fieldsearch'/>";
            echo " [<a href=\"javascript:sendStr('".$v["id"]."','".$_GET["idField"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
            echo "</td></tr>";
        }
    ?>
    </table>
    <div><span style="float:left"><b>Page:</b></span>
        <?=$pagging?>
    </div>
</fieldset>
</td><tr>
</table>

<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>

</body>
</html>
