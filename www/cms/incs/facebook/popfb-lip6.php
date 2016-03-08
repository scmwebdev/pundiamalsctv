<?
/**
* created 2013-Jan
* by Wisnu Alamsyah - alamsyah.org
*/
session_start();
require_once("../config.inc.php");
require_once("../function.inc.php");
session_cache_expire(SESS_TIME/3600);
session_name("bcms-sess");
require_once PEAR_DIR.'MDB2.php';
require_once INC_DIR.'auth.lib.php';
require_once INC_DIR.'memcached.php';

$bauth = new Auth();
$bauth->checkSession();

// check auth
if(!empty($_SESSION['login']) && $_SESSION['login'] == "admin") define("URIGHT", 1);
else {
    if(!$bauth->checkAuth(@$_REQUEST['mod'],"add")) define("URIGHT", 0);
    else define("URIGHT", 1);
}
        
if(!$bauth->checkSession() && URIGHT):

    // Rutin FB Cek
    include("facebook.php");

    $appid      = '160621007401976';
    $appsecret  = '1e73f1891e9ec76712516f1915b21837';
    $pageID     = '36786411434';
    //$pageID     = '344944405525823';
     
    $facebook = new Facebook(array(
        'appId' => $appid,
        'secret' => $appsecret,
        'cookie' => true
    ));

    if (isset($_REQUEST['logout'])) {
        $facebook->destroySession();
        die('<script type="text/javascript">parent.location.reload();parent.$.fancybox.close();</script>');
    }
    
    $user = $facebook->getUser();
    if (!$user) {
        $loginUrl = $facebook->getLoginUrl(array(
            "scope" => 'offline_access, publish_stream, read_insights, manage_pages, photo_upload, video_upload, create_note, manage_notifications'
        ));
        
        die('<p align="center"><a href="'.$loginUrl.'">LOGIN to FACEBOOK</a></p>');
    }
    
    $user_profile   = $facebook->api('/me');
    $user_token     = $facebook->getAccessToken();
    
    $accounts   = $facebook->api('/me/accounts?access_token='.$user_token);
    $page_token = 0;
    $page_name = '';
    foreach ($accounts['data'] as $account) {
        if ($account['id'] == $pageID) {
            $page_token = $account['access_token'];
            $page_name  = $account['name'];
        }
    }
    
    if (empty($page_token)) die('<p align="center">You are not Authorized to Manage FB Fan Page.<br/><a href="http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].'&logout">LOGOUT</a></p>');
    // end FB Cek


    // tangkep variable2 nya...
    $id_nya = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

    require_once MOD_DIR.'news/news.lib.php';
    $bcms = new News;
    $bcms->id = $id_nya;
    $data = $bcms->get();

    $title = strip_tags(html_entity_decode($data['title']));
    $title = preg_replace("/[\/_|+ ]+/", ' ', $title);
    $title = stripslashes($title);

    // make a URL small with bit.ly
    function make_bitly_url($url, $login, $appkey, $format = 'xml',$version = '2.0.1'){
        //make to lp.co
        $link = file_get_contents('http://lp6.co/api.php?signature=895019037b&format=simple&action=shorturl&url='.urlencode($url));
        if (!empty($link)) return $link;
        
        //create the URL
        $bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url). '&login='.$login.'&apiKey='.$appkey.'&format='.$format;

        //get the url

        //could also use cURL here
        $response = file_get_contents($bitly);

        //parse depending on desired format
        if(strtolower($format) == 'json') {
            $json = @json_decode($response,true);
            return $json['results'][$url]['shortUrl'];
        } else { //xml
            $xml = simplexml_load_string($response);
            return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
        }

    }

/* Parameters for bt.ly */

    $longurl = $data['link'];
    $login = "liputan6"; //username login bit.ly
    $appkey = "R_2ed178bfc2323a0b20a2fb5051b8a5aa"; //API key
    $shorturl_1 = make_bitly_url ($longurl, $login, $appkey, 'json');


?>

<script language="javascript" type="text/javascript">

    var ns6=document.getElementById&&!document.all;

    function restrictinput(maxlength,e,placeholder){
        if (window.event&&event.srcElement.value.length>=maxlength)
            return false
        else if (e.target&&e.target==eval(placeholder)&&e.target.value.length>=maxlength){
            var pressedkey=/[a-zA-Z0-9\.\,\/]/ //detect alphanumeric keys
            if (pressedkey.test(String.fromCharCode(e.which)))
                e.stopPropagation()
        }
    }

    function countlimit(maxlength,e,placeholder){
        var theform=eval(placeholder)
        var lengthleft=maxlength-theform.value.length
        var placeholderobj=document.all? document.all[placeholder] : document.getElementById(placeholder)
        if (window.event||e.target&&e.target==eval(placeholder)){
        if (lengthleft<0)
            theform.value=theform.value.substring(0,maxlength)
            placeholderobj.innerHTML=lengthleft
        }
    }

    function displaylimit(theform,thelimit){
        var limit_text='<b><span id="'+theform.toString()+'">'+thelimit+'</span></b>'
        if (document.all||ns6)
            document.write(limit_text)
        if (document.all){
            eval(theform).onkeypress=function(){ return restrictinput(thelimit,event,theform)}
            eval(theform).onkeyup=function(){ countlimit(thelimit,event,theform)}
        } else if (ns6){
            document.body.addEventListener('keypress', function(event) { restrictinput(thelimit,event,theform) }, true);
            document.body.addEventListener('keyup', function(event) { countlimit(thelimit,event,theform) }, true);
        }
    }
    function tutupRefresh() {
        //parent.location.reload();
        parent.$.fancybox.close();
    }

</script>
<style>
    h2 {
        font-family: verdana;
        font-size:16px;
        text-shadow: black 0.1em 0.1em 0.2em;
        text-align: center;
        margin-bottom:10px;
        padding-bottom:5px;
        border-bottom: 2px #ccc solid;
    }
</style>

<h2>Send News to Facebook Fan Page</h2>

<form id="myForm" name="myForm" method="post" action="index.php?mod=<?=$_REQUEST['mod']?>" onSubmit="return dataValidation()">
<table>
<tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
    <td nowrap="nowrap" class="content">FB Fan Page :</td>
    <td class="content"><?=$page_name?></td>
</tr>
<tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
    <td nowrap="nowrap" class="content">Message :</td>
    <td class="content">
        <textarea name="fb_message" style="width:400px" rows="3"><?=$title?></textarea>
    </td>
</tr>

<?php if($shorturl_1): ?>

<tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
    <td nowrap="nowrap" class="content">URL 1 :</td>
    <td class="content">
    <? $shorturl = $shorturl_1;
        echo "<a href=$shorturl target=_blank>$shorturl</a>";
    ?>
    </td>
</tr>



<?php else:

/* make a small with tinyurl */

    function TinyURL($u){
        return file_get_contents('http://tinyurl.com/api-create.php?url='.$u);
    }

    $shorturl_2 = TinyURL($longurl);

?>

<tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
    <td nowrap="nowrap" class="content">URL 2 :</td>
    <td class="content">
    <? $shorturl = $shorturl_2;
        echo $shorturl; ?>
    </td>
</tr>
<?php endif; ?>

<tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
    <td class="content" colspan="2" style="text-align:right">
        <input name="id" type="hidden" value="<?=$data['id']?>" />
        <input name="news_url" type="hidden" value="<?=$shorturl; ?>" />

        <script>displaylimit("document.myForm.fb_message",109)</script>
        <input class="pub" name="submit" type="submit" value="Submit" />
        <input class="pub" name="cancel" type="button" value="Cancel" onClick="tutupRefresh()"/>
    </td>
</tr>
</table>
</form>



<? else: ?>
Sorry. You can't access the page.<br/>
Please, Contact your administrator...
<? endif; ?>
