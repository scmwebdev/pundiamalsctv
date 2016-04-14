<?php
$uri = $this->uri->uri_string();
!empty($uri)?$loc = $uri : $loc = 'home';
if (!isset($link_active)) $link_active = 'home';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($page_title)?$page_title.' - ':'' ?>Kick Off</title>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.182.js"></script>
<link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/css/streaming.css?102" rel="stylesheet" type="text/css" />
<link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/css/small-player.css" rel="stylesheet" type="text/css" />

<?php if (empty($sess)) { ?>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/fb.js?1"></script>
<?php } ?>

<?php if($link_active == 'jadwal') { ?>
<link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/css/tabcontent.css?<?=date('d')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/tabcontent.js"></script>
<?php } ?>

<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);
b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
mixpanel.init("b9ec3a674650e97e994cc9f0b94e03c1");</script><!-- end Mixpanel -->

</head>
<body>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://analytics.kmkonline.co.id/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "2"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-38007844-31', 'liputan6.com');
  ga('send', 'pageview');

</script>
<div id="fb-root"></div>
<div class="bpl-index">
<!-- e: liputan 6 -->
        <div class="outer_bpl">
                <ul class="nav-lip6">
                    <li>
                    <a href="http://www.liputan6.com" target="_blank"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-liputan6.png" width="107" height="29" alt="" /></a>
                        <div class="sub-nav-wrapper2">
                            <ul class="sub-nav">
                                <li><a href="http://news.liputan6.com" target="_blank">News</a></li>
                                <li><a href="http://bisnis.liputan6.com" target="_blank">Bisnis</a></li>
                                <li><a href="http://bola.liputan6.com" target="_blank">Bola</a></li>
                                <li><a href="http://showbiz.liputan6.com" target="_blank">Showbiz</a></li>
                                <li><a href="http://tekno.liputan6.com" target="_blank">Tekno</a></li>
                                <li><a href="http://health.liputan6.com" target="_blank">Health</a></li>
                                <li><a href="http://foto.liputan6.com" target="_blank">Foto</a></li>
                                <li><a href="http://video.liputan6.com" target="_blank">Video</a></li>
                                <li><a href="http://video.liputan6.com/streaming" target="_blank">Streaming</a></li>
                                <li><a href="http://deal.liputan6.com" target="_blank">Deal</a></li>
                                <li><a href="http://liputan6.com/indeks/terkini" target="_blank">Index</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
        </div>
        <!-- e: liputan 6 -->
    <!-- s: menu -->
        <div class="menu-bpl-out">
            <div class="menu-bpl">
                        <a <?php if($link_active == "home") { echo 'class="active"'; } ?> href="<?php echo base_url();?>">HOME</a>
                        <a <?php if($link_active == "jadwal") { echo 'class="active"'; } ?> href="<?php echo site_url('jadwal');?>">JADWAL</a>
                        <a <?php if($link_active == "pertandingan") { echo 'class="active"'; } ?>href="<?php echo site_url('pertandingan');?>">PERTANDINGAN LIVE</a>
                        <?php
                        if (!empty($sess) && $sess['id_profile'] > 0 && $sess['is_validate'] == '1') :
                        ?>
                            <a <?php if($link_active == "profil") { echo 'class="active"'; } ?>href="<?php echo site_url('profil');?>">PROFIL</a>
                        <?php
                        endif;
                        ?>
                </div>
        </div>
    <!-- e: menu -->

        <div class="outer_bpl">
          <?php if (empty($sess)) { ?>

                <div class="user-login">
                        <a class="login-g right ml-5" href="<?php echo site_url('google/connect');?>?location=<?php echo $loc; ?>"></a>
                        <a class="login-tw right ml-5" href="<?=site_url('twitter/connect')?>?location=<?php echo $loc; ?>"></a>
                        <a class="login-fb right ml-5" href="javascript:;" onclick="login_fb()"></a>
                        <div class="clearit"></div>
                </div>

            <?php } else { ?>

            <div class="user-login">
                    Welcome, <span><?=$sess['full_name']?></span>
                        <a href="<?=site_url('logout')?>"><input class="logout" type="submit" value="Logout" /></a>
                </div>

            <?php } ?>

            <a class="logo-kickoff" href="<?php echo site_url(); ?>"></a>
                <h1 class="title">the battle begins!!!</h1>
                <h1 class="title-2">Watch anytime, anywhere. </h1>

