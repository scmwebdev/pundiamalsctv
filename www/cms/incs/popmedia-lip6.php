<?
    session_start();
    require_once("config.inc.php");
    require_once("function.inc.php");
    session_cache_expire(SESS_TIME/3600);
    session_name("bcms-sess");
    require_once PEAR_DIR.'MDB2.php';
    require_once MOD_DIR.'l6-media.lib.php';
    $bcms         = new L6Media();

    $arrType = array(
    'picID'         => 'Picture (News)',
    'tpicID'         => 'Thumb. Picture (News)',
    'vidID'         => 'Video (News)',
    //'audID'         => 'Audio (News)',
    'galID'         => 'Gallery',
    'mpicID'         => 'Mobile Picture',
    'mvidID'         => 'Mobile Video',
    'karikaturID'     => 'Karikatur News',
    'karipemiluID'     => 'Karikatur Pemilu',
    'beritagambarID'=> 'Berita Photo',
    'pic'             => 'Picture (Music)',
    'tpic'             => 'Thumbnail Picture (Music)',
    //'aud'             => 'Audio (Music)',
    'vid'             => 'Video (Music)',
    //'wacp'             => 'Web Audio Clip (Preview) - MP3/WMA',
    //'wacf'             => 'Web Audio Clip (Full Version) - MP3/WMA',
    'wvcp'             => 'Web Video Clip (Preview) - FLV',
    'wvcf'             => 'Web Video Clip (Full Version) - FLV',
    'mvc'             => 'Mobile Video Clip - 3GP',
    //'mrbt'             => 'Mobile Ring Back Tone',
    //'mrt'             => 'Mobile Ring Tone - MP3/WMA'
    'grt'             => 'Gallery Ramadhan (Thumbnail)',
    'grp'             => 'Gallery Ramadhan (Picture)'
    );

    $_act      = (isset($_GET["act"])?$_GET["act"]:"");
    $_page     = (isset($_GET["page"])?$_GET["page"]:"1");
    $c_id      = (isset($_GET["kategori"])?$_GET["kategori"]:"");
    $tgl       = (isset($_GET["tanggal"])?$_GET["tanggal"]:"");
    $keysearch = (isset($_GET["keysearch"])?$_GET["keysearch"]:"");
    $fldsearch = (isset($_GET["fldsearch"])?$_GET["fldsearch"]:"");
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
<body bgcolor="#99CC99" link="#0000FF" vlink="#0000FF" alink="#FF0000">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr><td class="tbl_font">
    <fieldset class="tbl_font"><legend class="tbl_font">Pop Up <b>Media</b> Explorer</legend>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
        <table width="100%" border="0">
            <tr>
                <td class="tbl_font">Category</td>
                <td class="tbl_font">:
                    <?  $listkategori     = $bcms->selectCategoryMedia();?>
                    <select style="width:140px" name="kategori" class="fieldsearch" >
                        <?

                        foreach($listkategori as $k => $v)
                        {
                            echo '<option value="'.$v['cat_id'].'" '.($c_id==$v['cat_id']?" selected ":"").'>'.$v['cat_name'].'</option>';
                        }

                        echo "<option value='' ".($c_id==''?" selected ":"").">-- All Category --</option>";
                        ?>
                    </select>
                </td>
                <td class="tbl_font" align="right">
                </td>
            </tr>
            <? /*
            <tr><td class="tbl_font">Dateinsert</td>
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
                    <input type="text" name="keysearch"  style="width:140px" class="fieldsearch" value="<?=$keysearch?>">
                    <?
                    require_once MOD_DIR.'l6-media.lib.php';
                    $bcms = new L6Media();
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
                    <input type="hidden" name="idFrm"     value="<?=$_GET["idFrm"]?>">
                    <input type="hidden" name="idField" value="<?=$_GET["idField"]?>">
                    <input type="hidden" name="mod"     value="<?=$_GET["mod"]?>">
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
                showsTime        : true,
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
    $data        = $bcms->getListDataMediaAll($c_id,$tgl,0,$keysearch,$fldsearch,$_page);
    $totRec      = $bcms->totRec;
    $makeUrl     = $_SERVER['PHP_SELF']."?tanggal=".$tgl."&kategori=".$c_id."&idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".                                $fldsearch;
    $pagging     = getPagging($makeUrl,$_page,$totRec);
    ?>
    <strong>Page:</strong> <?=$pagging?><br />
    <table width="100%" border="0" cellpadding="1" cellspacing="2" >
    <tr>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Picture</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Type</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Category</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Caption</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Filename</strong></td>
        <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
    </tr>
    <?
    $ii=0;
    foreach($data as $k => $v){
            $ii++;
            if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
            else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
            echo "<td class='tbl_font' align='center'>";
            if($v["type"]=='grt' OR $v["type"]=='grp' OR $v["type"]=='tpic' OR $v["type"]=='pic' OR $v["type"]=='beritagambarID' OR $v["type"]=='karipemiluID' OR $v["type"]=='karikaturID' OR $v["type"]=='mpicID' OR $v["type"]=='galID' OR $v["type"]=='tpicID' OR $v["type"]=='picID')
            {
                echo " <img src='".MEDIA_LIPUTAN6.$v["location"]."' width='57' /> ";
            }
            else
            {
                echo " [<a href='".MEDIA_LIPUTAN6.$v["location"]."'>FILE</a>]";
            }
            echo "</td>";
            echo "<td align='center' class='tbl_font'>".@$arrType[$v["type"]]."</td>";
            echo "<td class='tbl_font'>".$bcms->getKategoriMedia($v["cat_id"])."</td>";
            echo "<td class='tbl_font'>".$v["caption"]."</td>";
            echo "<td class='tbl_font'>".$v["filename"]."</td>";
            echo "<td class='tbl_font' style='text-align:center'>";
            echo " [<a href=\"javascript:sendStr('".$v["id"]."','".$_GET["idField"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
            echo "</td></tr>";
    }
    ?>
    </table>
    <strong>Page:</strong> <?=$pagging?>
    </fieldset>
    </td><tr>
    </table>

</body>
</html>
