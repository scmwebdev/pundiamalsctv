<?
/**
 * created 2010-Nov-11
 * by wibawa.priatama@sctv.co.id
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
}?>

<?
if(!$bauth->checkSession() && URIGHT):

    // tangkep variable2 nya...
    $id_nya = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
    $twitter_status = isset($_REQUEST['twitter']) ? $_REQUEST['twitter'] : 0;

    require_once MOD_DIR.'tv-video.lib.php';
    $bcms = new tvvideo;
    $data = $bcms->getData($id_nya);

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
    $longurl = $data['linkvideo_web'];
    $login = "liputan6"; //username login bit.ly
    $appkey = "R_2ed178bfc2323a0b20a2fb5051b8a5aa"; //API key
    $shorturl_1 = make_bitly_url ($longurl, $login, $appkey, 'json');?>

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

        function dataValidation(){
            if (document.myForm.title.value=="") {
            alert("No Title !")
            document.myForm.title.focus()
            return false
            }
            return true
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

    <h2>Tweet Video to Twitter</h2>

    <form id="myForm" name="myForm" method="post" action="index.php?mod=<?=$_REQUEST['mod']?>" onSubmit="return dataValidation()">
        <table>
            <tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
                <td nowrap="nowrap" class="content">Tweet :</td>
                <td class="content">
                    <textarea name="title_to_twitter" style="width:400px" rows="3">Video: <?=$title?></textarea>
                </td>
            </tr>

            <?php if($shorturl_1): ?>

                <tr class="out" onmouseover='this.className="over"' onmouseout='this.className="out"'>
                    <td nowrap="nowrap" class="content">URL 1 :</td>
                    <td class="content">
                    <? $shorturl = $shorturl_1;
                        echo $shorturl;
                    ?>
                    </td>
                </tr>

            <?php else:

                /* make a small with tinyurl */
                function TinyURL($u){
                    return file_get_contents('http://tinyurl.com/api-create.php?url='.$u);
                }
                $shorturl_2 = TinyURL($longurl);?>

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
                    <input name="twitter_status" type="hidden" value="<?=$twitter_status ?>" />
                    <input name="news_url" type="hidden" value="<?=$shorturl; ?>" />

                    <script>displaylimit("document.myForm.title_to_twitter",109)</script>
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
