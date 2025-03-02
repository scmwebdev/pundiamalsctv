<?
/**
 * Main Function
 *
 * @access      public
 * @author      bonny.hp
 * @since       2006-10-19
 * @version     2.0 MDB2
 */

/**
 * loggin system
 */
function logging($act=null){
    $mdbLog = MDB2::factory(DSN);
    $mdbLog->setFetchMode(MDB2_FETCHMODE_ASSOC);
    if(LOGGING == "monthly" || LOGGING == "all"){
        $strTable = (LOGGING=="monthly"?LOGGING_PREFIX.date("Ym"):LOGGING_PREFIX."all");
        $_query = "SHOW TABLES FROM db_bcms LIKE '".$strTable."'";
        $res = $mdbLog->queryAll($_query);
        if (PEAR::isError($res)) die($res->getMessage());

        if(count($res)=="0"){ // create table
            $_create = "
                CREATE TABLE `".$strTable."` (
                    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                    `login` VARCHAR( 20 ) NOT NULL ,
                    `datetime` DATETIME NOT NULL ,
                    `ip` VARCHAR( 20 ) NOT NULL ,
                    `query` TEXT NOT NULL,
                    INDEX ( `login` , `ip` ) )
                ";
            $res = $mdbLog->exec($_create);
            if (PEAR::isError($res)) die($res->getMessage());
        }

        $_insert = "INSERT INTO ".$strTable."(`id`,`login`,`datetime`,`ip`,`query`) VALUES(
            '','".$_SESSION["login"]."',NOW(),'".$_SERVER["REMOTE_ADDR"]."','".$act."') ";
        $res = $mdbLog->exec($_insert);
        if (PEAR::isError($res)) die($res->getMessage());
    }
    $mdbLog->disconnect();
}

/**
 * get pagging
 */
function getPagging($strUrl=null,$page=1,$totRec=0,$recPerPage=0){

    $strPage = "";
    $strUrl .= "&page=";

    $i_add = floor(($page-1)/10)*10;
    $totPage = ceil($totRec/($recPerPage?$recPerPage:REC_PER_PAGE));

    for($i=1;$i<=10;$i++){
        $_page = $i+$i_add;
        if($_page <= $totPage){
            if($_page == $page) $strPage .= '<b>'.$_page.'</b> ';
            else $strPage .= '<a href="'.$strUrl.$_page.'" class="pagging">'.$_page.'</a> ';
        }
    }

    $first = '<a href="'.$strUrl.'1" class="pagging"><<</a> <a href="'.$strUrl.$i_add.'" class="pagging"><</a> ';
    $last = '<a href="'.$strUrl.($i_add+11).'" class="pagging">></a> <a href="'.$strUrl.$totPage.'" class="pagging">>></a> ';

    if($i_add) $strPage = $first.$strPage;
    if(10+$i_add < $totPage) $strPage = $strPage.$last;

    return $strPage;
}

/**
 * get new pagging
 */
function createPagging($strUrl=null,$page=1,$totRec=0,$recPerPage=0, $spasi=10){

    $strPage = '';
    $strUrl .= "&page=";

    $i_add = floor(($page-1)/$spasi)*$spasi;
    $totPage = ceil($totRec/($recPerPage?$recPerPage:REC_PER_PAGE));

    for($i=1;$i<=$spasi;$i++){
        $_page = $i+$i_add;
        if($_page <= $totPage){
            if($_page == $page) $strPage .= '<li><span class="current">'.$_page.'</span></li> ';
            else $strPage .= '<li><a href="'.$strUrl.$_page.'">'.$_page.'</a></li> ';
        }
    }

    $first = '<li><a href="'.$strUrl.'1"><<</a></li><li><a href="'.$strUrl.$i_add.'"><</a></li> ';
    $last = '<li><a href="'.$strUrl.($i_add+11).'">></a></li> <li><a href="'.$strUrl.$totPage.'" class="pagging">>></a></li> ';

    if($i_add) $strPage = $first.$strPage;
    if(10+$i_add < $totPage) $strPage = $strPage.$last;

    return '<ul id="paginationWKTOP" class="clearfix">'.$strPage.'</ul>';
}

/**
 * create alphabet
 */
function show_alphabetic($current=null){

    $strPage = '';
    parse_str($_SERVER['QUERY_STRING'], $query_string);
    unset($query_string['page']);
    $query_string['alpha']='';
    $strUrl = $_SERVER['PHP_SELF'].'?'.http_build_query($query_string);
    $arr_data = array_merge(range('A','Z'), range('1','9'));
    foreach($arr_data as $k=>$v){
        if($current == $v)
            $strPage .= '<li><span class="current">'.$v.'</span></li> ';
        else
            $strPage .= '<li><a href="'.$strUrl.$v.'">'.$v.'</a></li> ';
    }

    return '<ul id="paginationWKTOP" class="clearfix">'.$strPage.'</ul>';
}

/**
 * write xml
 */
function writeXML($destination, $data) {

    $b_status = false;
    $a_destination = explode('.', $destination);
    $tmp_destination = $a_destination[0].'_tmp.'.$a_destination[1];

    if (($handle = @fopen($destination, 'r')) === FALSE) {

        // write new xml data
        if ($handle = fopen($destination, 'w')) {
            fwrite($handle, $data);
            fclose($handle);
            $b_status = true;
        }
    } else {

        fclose($handle);

        if ($handle = fopen($tmp_destination, 'w')) {

            fwrite($handle, $data);
            fclose($handle);

            if (copy($destination, 'logs/'.$a_destination[0].'_'.date('YmdHis').'.'.$a_destination[1])) {
                 if (copy($tmp_destination, $destination)) {
                     $b_status = true;
                 }
            }
        }
    }

    return $b_status;

}

/**
 * rewrite title
 */
function rewriteTitle($strTitle=''){

    $strTitle = strip_tags($strTitle);
    $strTitle = str_replace('   ',' ',$strTitle);
    $strTitle = str_replace('  ',' ',$strTitle);
    $strTitle = str_replace(' ','-',$strTitle);

    return $strTitle;
}

/**
 * validate xml
 */
function validateXML($s_xml) {

    $s_xml = str_replace("<br/>", "<br />", $s_xml);
    $s_xml = str_replace("�", "&rsquo;", $s_xml);
    $s_xml = str_replace("�", "&ldquo;", $s_xml);
    $s_xml = str_replace("�", "&rdquo;", $s_xml);
    $s_xml = str_replace("�", "&lsquo;", $s_xml);

    $s_xml = str_replace("�", "&mdash;", $s_xml);

    /*$s_xml = str_replace("&lsquo;", "'", $s_xml);
    $s_xml = str_replace("&rsquo;", "'", $s_xml);
    $s_xml = str_replace("&ldquo;", "'", $s_xml);
    $s_xml = str_replace("&rdquo;", "'", $s_xml);
    $s_xml = str_replace("&rdquo;", "'", $s_xml);*/
    $s_xml = str_replace("'", "&rsquo;", $s_xml);
    //$s_xml = str_replace("?", "", $s_xml);
    //$s_xml = str_replace("&bull;", "�", $s_xml);
    $s_xml = str_replace("�", "e", $s_xml);

    return $s_xml;

}

function deleteFromArray(&$array, $deleteIt, $useOldKeys = FALSE) {
    $tmpArray = array();
    foreach ($array as $key => $value) {
        if ($value !== $deleteIt) {
            if (FALSE === $useOldKeys) {
                $tmpArray[] = $value;
            } else {
                $tmpArray[$key] = $value;
            }
        }
    }
    $array = $tmpArray;
    return $array;
}


function url_title($title) {
    $clean = html_entity_decode(html_entity_decode($title));
    $clean = strip_tags($clean);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    $clean = strtolower(trim($clean, '-'));
    return $clean;
}

function gambar_default($id = null) {
    switch ($id) {
        case '490x242' : $temp = '490x242.jpg'; break;
        case '320x240' : $temp = '320X240.jpg'; break;
        case '300x250' : $temp = '300x250.jpg'; break;

        case '673x373' : $temp = '673x373.jpg'; break;
        case '304x171' : $temp = '304x171.jpg'; break;
        case '144x81'  : $temp = '144x81.jpg'; break;

        case '90x74'   : $temp = '90x74.jpg'; break;
        default        : $temp = '55x45.jpg';
    }
    return ASSETS.'images/default/'.$temp;
}

function citizen_news($text) {
    $allow = '<p><a><b><i><br>';
    $result = html_entity_decode($text);
    $result = strip_tags($result, $allow);
    return $result;
}

function sql_exec($database='xxx', $method='read', $query, $param=0, $fetch=false) {
    $result = FALSE;
    try {
        if ($database == 'xxx') {
            $db = new PDO(DSN_WRITE, USER_WRITE, PASS_WRITE);
        } else {
            $db = new PDO(DSN_TOOLS, USER_TOOLS, PASS_TOOLS);
        }
        $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        //if (HOST == 'local') {
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        //}
        $stmt = $db->prepare($query);
        $param = empty($param) ? array() : $param;
        $stmt->execute($param);
        if ($method == 'read') {
            if ($fetch) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        $db = NULL;
    } catch (PDOException $e) {
        echo "<b>Error:</b> <pre>";
        print_r($e->__toString());
        echo "</pre>";
    }
    return $result;
}


function fase_competition($fase=0) {
    switch ($fase) {
        case 8 : $result = 'Round of 16'; break;
        case 4 : $result = 'Quarter Final'; break;
        case 2 : $result = 'Semi Final'; break;
        case 1 : $result = 'Final'; break;
        default: $result = 'Undefined';
    }
    return $result;
}

function match_position($pos=0) {
    switch ($pos) {
        case 1 : $result = 'Kiper'; break;
        case 2 : $result = 'Bek'; break;
        case 3 : $result = 'Gelandang'; break;
        case 4 : $result = 'Striker'; break;
        default: $result = 'Undefined';
    }
    return $result;
}

function limit_words($string, $word_limit) {
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}

function show_code($str,$die=false) {
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    if ($die) die;
}



/**
 * Returns an string clean of UTF8 characters. It will convert them to a similar ASCII character
 * www.unexpectedit.com
 */
function cleanString($text) {
    // 1) convert � � => a o
    /*
    $text = preg_replace("/[�����]/u","a",$text);
    $text = preg_replace("/[�����]/u","A",$text);
    $text = preg_replace("/[����]/u","I",$text);
    $text = preg_replace("/[����]/u","i",$text);
    $text = preg_replace("/[����]/u","e",$text);
    $text = preg_replace("/[����]/u","E",$text);
    $text = preg_replace("/[������]/u","o",$text);
    $text = preg_replace("/[�����]/u","O",$text);
    $text = preg_replace("/[����]/u","u",$text);
    $text = preg_replace("/[����]/u","U",$text);
    $text = preg_replace("/[?????]/u","'",$text);
    $text = preg_replace("/[??��?]/u",'"',$text);
    */
    $text = str_replace("?","-",$text);
    $text = str_replace(" "," ",$text);
    $text = str_replace("�","c",$text);
    $text = str_replace("�","C",$text);
    $text = str_replace("�","n",$text);
    $text = str_replace("�","N",$text);

    //2) Translation CP1252. &ndash; => -
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
    $trans[chr(134)] = '&dagger;';    // Dagger
    $trans[chr(135)] = '&Dagger;';    // Double Dagger
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
    $trans[chr(137)] = '&permil;';    // Per Mille Sign
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
    $trans[chr(149)] = '&bull;';    // Bullet
    $trans[chr(150)] = '&ndash;';    // En Dash
    $trans[chr(151)] = '&mdash;';    // Em Dash
    $trans[chr(152)] = '&tilde;';    // Small Tilde
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
    $trans['euro'] = '&euro;';    // euro currency symbol
    ksort($trans);

    foreach ($trans as $k => $v) {
        $text = str_replace($v, $k, $text);
    }

    // 3) remove <p>, <br/> ..., kecuali : <!-- 6pagebreak --> (Untuk page break)

    $text=str_replace("<!-- l6pagebreak -->","{!-- l6pagebreak --}",$text);
    // Kembalikan format {l6 ke <l6
    $text=str_replace("<l6 style",'{l6 style',$text);
    // Kembalikan format {\/l6> ke </l6>
    $text=str_replace("</l6>",'{/l6>',$text);

    // Kembalikan format {l6 ke <l6
    $text=str_replace("{l6 style",'<l6 style',$text);
    // Kembalikan format {\/l6> ke </l6>
    $text=str_replace("{/l6>",'</l6>',$text);

    $text=str_replace("{!-- l6pagebreak --}","<!-- l6pagebreak -->",$text);

    // 4) &amp; => & &quot; => '
    $text = html_entity_decode($text);

    // 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
    $text = preg_replace('/[^(\x20-\x7F)]*/','', $text);

    $targets=array('\r\n','\n','\r','\t');
    $results=array(" "," "," ","");
    $text = str_replace($targets,$results,$text);

    //XML compatible
    /*
    $text = str_replace("&", "and", $text);
    $text = str_replace("<", ".", $text);
    $text = str_replace(">", ".", $text);
    $text = str_replace("\\", "-", $text);
    $text = str_replace("/", "-", $text);
    */

	$text = str_replace("'", "\'", $text);
    return ($text);
}


?>
