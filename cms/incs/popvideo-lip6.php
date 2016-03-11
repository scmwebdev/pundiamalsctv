<?php
    session_start();
    require_once("config.inc.php");
    require_once("memcached.php");
    require_once("function.inc.php");
    session_cache_expire(SESS_TIME/3600);
    session_name("bcms-sess");
    require_once PEAR_DIR.'MDB2.php';
    require_once INC_DIR.'auth.lib.php';
    $bauth = new Auth();
    require_once MOD_DIR.'tv-video.lib.php';
    $bcms  = new tvvideo();

    $mod = isset($_REQUEST["mod"]) ? $_REQUEST["mod"] : "";
    $bauth->checkSession();
    if(!empty($_SESSION["login"]) && $_SESSION["login"] == "admin") define("URIGHT", 1);
    else {
        if(!$bauth->checkAuth($mod,"add")) define("URIGHT", 0);
        else define("URIGHT", 1);
    }

    $_page     = isset($_GET["page"])?$_GET["page"]:"1";
    $c_id     = isset($_GET["kategori"])?$_GET["kategori"]:($mod == 'musik-song' ? 10 : '');
    $tgl     = isset($_GET["tanggal"])?$_GET["tanggal"]:"";

    $keysearch = isset($_GET["keysearch"]) ? $_GET["keysearch"] : '';
    $fldsearch = isset($_GET["fldsearch"]) ? $_GET["fldsearch"] : '';

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="popimg.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?=TPL_URL?>webadmin/css/pagging.css" />
    <link rel="stylesheet" type="text/css" href="<?=TPL_URL?>webadmin/css/jquery.fancybox-1.3.4.css" />
    <script language="javascript" type="text/javascript" src="<?=TPL_URL?>webadmin/jquery-1.3.2.min.js" ></script>
    <script language="javascript" type="text/javascript" src="<?=TPL_URL?>webadmin/js/jquery.fancybox-1.3.4.pack.js" ></script>

    <script type="text/javascript">
        function sendStr(aString,aField,aFrm){
            eval('top.opener.document.'+aFrm+'.'+aField+'.value = "'+aString+'"');
            parent.window.close();
        }
    </script>
</head>
<body bgcolor="#99CC99" link="#0000FF" vlink="#0000FF" alink="#FF0000">
<? if(!$bauth->checkSession() && URIGHT): ?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr><td class="tbl_font">

    <fieldset class="tbl_font"><legend class="tbl_font">Pop Up <b>Video Liputan6.TV</b> Explorer</legend>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="get" name="form1" id="form1">
        <table width="100%" border="0">
            <tr>
                <td class="tbl_font">Category</td>
                <td class="tbl_font">:
                    <?  $listkategori     = $bcms->selectKategori();?>
                    <select style="width:140px" name="kategori" class="fieldsearch" id="kategori">
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
            <tr>
                <td class="tbl_font">Search </td>
                <td class="tbl_font">:
                    <input type="text" name="keysearch"  style="width:140px" class="fieldsearch">
                    <?
                    $field = $bcms->getField();
                    ?>
                    <select name="fldsearch" class="fieldsearch">
                    <option value="">--Select--</option>
                    <?
                    foreach($field as $k => $v){
                        if($v<>'Type')
                        {
                               echo '<option value="'.$k.'">'.$v.'</option>';
                        }
                    }
                    ?>
                    </select>
                    <input type="submit" class="form_button" value="Display">
                    <input type="hidden" name="act"     value="search">
                    <input type="hidden" name="idFrm"     value="<?=$_GET["idFrm"]?>">
                    <input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
                    <input type="hidden" name="mod"     value="<?=$_GET["mod"]?>">
                </td>
            </tr>
        </table>
    </form>
    <hr size="1">
<?php

    $data     = $bcms->selectDataPop($c_id,0,$keysearch,$fldsearch,'',$tgl,$_page);
    $totRec   = $bcms->totRec;
    $makeUrl  = $_SERVER['PHP_SELF']."?tanggal=".$tgl."&kategori=".$c_id."&idFrm=".@$_GET["idFrm"]."&idField=".@$_GET["idField"]."&idField2=".@$_GET["idField2"]."&mod=".@$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".                                $fldsearch;
    $pagging  = createPagging($makeUrl,$_page,$totRec);
?>

    <div><span style="float:left"><b>Page:</b></span>
        <?=$pagging?>
    </div>

    <table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Video ID</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Thumbnail</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Category</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Title</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
    </tr>
    <?php
    $i=0;
    foreach($data as $k => $v) :
        $i++;
        if($i % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
        else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
        echo "<td class='tbl_font' width='75' align='center'><strong>[<a href=".SITE_URL.'news/video_embed.php?url='.$v['cat_id']."/".$v['id']." class='fancy'>".$v["id"]."</a>]</strong></td>";
        echo "<td class='tbl_font' width='110'><img width='110' height='60' src=".($bcms->getThumbnail($v["thumbid"])?MEDIA_LIPUTAN6.$bcms->getThumbnail($v["thumbid"]):TPL_URL."webadmin/images/noimage.jpg")."></td>";
        echo "<td class='tbl_font' width='80' align='center'>".$bcms->getKategori($v["cat_id"])."</td>";
        echo "<td class='tbl_font'>".$v["title"]."</td>";
        echo "<td class='tbl_font' width='80' align='center'>".$v["tanggal"]."</td>";
        echo "<td class='tbl_font' width='50' style='text-align:center'>";
        echo " [<a href=\"javascript:sendStr('".$v["id"]."','".$_GET["idField"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
        echo "</td></tr>";
    endforeach;

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

<script type="text/javascript">
    $(".fancy").fancybox({
        'overlayOpacity'    : 0.5,
        'width'                : 650,
        'height'            : 320,
        'autoScale'         : false,
        'transitionIn'        : 'elastic',
        'transitionOut'        : 'none',
        'type'                : 'iframe'
    });

    $("#kategori").change(function(){
        $("#form1").submit();
    });

</script>

</body>
</html>
