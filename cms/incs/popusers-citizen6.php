<?

/**
 * created 2011-Mar-02
 * by wibawa.priatama@sctv.co.id
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

if(!empty($_SESSION["login"]) && $_SESSION["login"] == "admin")
    define("URIGHT", 1);
else {
    if(!$bauth->checkAuth(@$_REQUEST["mod"],"add")) define("URIGHT", 0);
    else define("URIGHT", 1);
}

$id        = isset($_GET["id"]) ? $_GET["id"]: 0;
$page      = isset($_GET["page"]) ? $_GET["page"]: 1;
$keysearch = isset($_GET["keysearch"]) ? $_GET["keysearch"]: '';
$fldsearch = isset($_GET["fldsearch"]) ? $_GET["fldsearch"]: '';

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link type="text/css" rel="stylesheet" href="popimg.css" >
    <link type="text/css" rel="stylesheet" href="/tpls/webadmin/css/pagging.css" />
    <script type="text/javascript" src="/tpls/webadmin/jquery-1.3.2.min.js" ></script>
</head>
<body link="#0000FF" vlink="#0000FF" alink="#FF0000">

<? if(!$bauth->checkSession() && URIGHT): ?>
    <div class="tbl_font">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
        <table width="100%" border="0">
        <tr>
            <td class="tbl_font">Search</td>
            <td class="tbl_font">:
                <input type="text" name="keysearch" size="15" class="fieldsearch" value="<?=$keysearch?>">
                <?
                require_once MOD_DIR.'popusers-citizen6.lib.php';
                $bcms = new PopUsersC6();
                $field = $bcms->getField();
                ?>
                <select name="fldsearch" class="fieldsearch">
                    <option value="">--Select--</option>
                    <?
                    foreach($field as $k => $v){
                        $sel = $fldsearch == $k ? 'SELECTED' : '';
                        echo '<option value="'.$k.'" '.$sel.'>'.$v.'</option>';
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
        </table>
        <hr size="1">
        <?
            $bcms->setRecPerPage(20);
            $data = $bcms->getListData($id,$keysearch,$fldsearch,$page);
            $totRec = $bcms->totRec;

            $makeUrl = $_SERVER['PHP_SELF']."?idFrm=".$_GET["idFrm"]."&idField=".$_GET["idField"]."&mod=".$_GET["mod"]."&keysearch=".$keysearch."&fldsearch=".$fldsearch;
            $pagging = createPagging($makeUrl,$page,$totRec, 20);
        ?>
        <div><span style="float:left"><b>Page:</b></span><?=$pagging?></div>
        <table width="100%" border="0" cellpadding="1" cellspacing="2" >
            <tr>
                <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>ID</strong></td>
                <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>Name</strong></td>
                <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>e-mail</strong></td>
                <td align="center" class='tbl_font' bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
            </tr>
            <?
            $ii=0;
            foreach($data as $k => $v){
                $ii++;
                if($ii % 2 == 0) echo "<tr class='out' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out';\">";
                else echo "<tr class='out2' onmouseover=\"this.className = 'over';\" onmouseout=\"this.className = 'out2';\">";
                echo "<td class='tbl_font' align='center' width='50'>";
                echo $v["id_member"];
                echo "</td>";
                echo "<td class='tbl_font' width='300'>".$v["fname"].' '.$v["lname"]."</td>";
                echo "<td class='tbl_font'>".$v["email"]."</td>";
                echo "<td class='tbl_font' style='text-align:center'>";
                //echo " [<a class='klik' href=\"javascript:sendStr('".$v["id_member"]."','".$_GET["idField"]."','".$_GET["idFrm"]."')\"><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
                echo " [<a class='klik' href='".$v['id_member']."#".$v['email']."'><span style='color:#0000FF; font-weight:bold'>Pick</span></a>]";
                echo "</td></tr>";
            }
            ?>
        </table>
        </form>
    </div>
    <script>
        function sendStr(aString,aField){
            eval('top.opener.document.myForm.'+aField+'.value = "'+aString+'"');
            parent.window.close();
        }
        $('.klik').click(function(){
            var temp = $(this).attr('href').split('#');
            var id = temp[0];
            var email = temp[1];
            sendStr(id, 'id_member');
            sendStr(email, 'email_member');
            return false;
        });
    </script>
<? else: ?>
    Sorry. You can't access the page.<br/>
    Please, Contact your administrator...
<? endif; ?>

</body>
</html>
