<?php
$uri = $this->uri->uri_string();
!empty($uri)?$loc = $uri : $loc = 'home';
if (!isset($link_active)) $link_active = 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo isset($page_title)?$page_title.' - ':'' ?>Kick Off</title>
<meta charset="utf-8">

<link href="<?=base_url()?>favicon.ico" rel="icon" type="image/ico" />
<link href="<?=base_url()?>favicon.ico" rel="shortcut icon" type="image/ico" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/default.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/css/menu.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/js/jquery-1.7.1.min.js"></script>

<?php if (empty($sess)) : ?>
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/fb.js?1"></script>
<?php endif ?>

<?php if($page == 'jadwal') : ?>
<link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/css/tabcontent.css?<?=date('d')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/tabcontent.js"></script>
<?php endif ?>

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


<div id="wrapper">
<div id="leaderboard">
<div id="leadeboard-inside">
<div id="leadeboard-inside-banner" class="fl">
  <a href="#" target="_blank"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/kratingdaeng.jpg" style="padding-top:8px"></a>
</div>
<?php if (!empty($sess)) : ?>
  <div id="user" class="fl"><span style="color:#FFFF00">Hallo, <?=$sess['full_name']?></span>
    <p>
      <a href="<?=site_url('profil')?>">Profil</a>&nbsp;&nbsp;<a href="<?=site_url('logout')?>"><span style="border:1px solid #7f7f7f; background: #3e3e3e; padding:4px; border-radius:4px">Logout</span></a>
    </p>
    <p><a href="#<?//=site_url('profil/confirm')?>">Konfirmasi Pembayaran</a></p>
  </div>
<?php endif ?>
</div>
</div>

<div id="top">
<div id="top-inside">
  <div id="logo" class="fl">
    <img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/kickoff-logo.png">
  </div>
  <div id="separator" class="fl">
    <img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/shadow-separator.png">
  </div>
  <div id="menu-top" class="fl">
    <ul id="menu">
    <li><a<?=($link_active == "home") ? ' class="current"' : '' ?> href="<?=base_url()?>">HOME</a></li>
    <li><a<?=($link_active == "jadwal") ? ' class="current"' : '' ?> href="#">JADWAL</a><!-- Begin 5 columns Item -->

        <div class="dropdown_3columns"><!-- Begin 5 columns container -->

            <div class="col_3">
                <h2>Silahkan pilih <span style="color:#FF0000">jadwal liga</span> yang anda inginkan</h2>
            </div>

            <div class="col_1">
                <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bpl-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('jadwal/index/bpl')?>">Inggris</a></p>
            </div>

            <div class="col_1">
                <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/champions-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('jadwal/index/champions')?>">Champions</a></p>
            </div>

            <div class="col_1">
                <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/europa-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('jadwal/index/europa')?>">Europa</a></p>
            </div>

             <div class="col_1">
                <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/seriea-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('jadwal/index/serie-a')?>">Serie A</a></p>
            </div>

              <div class="col_1">
                <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bundesliga-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('jadwal/index/bundesliga')?>">Bundesliga</a></p>
            </div>

              <div class="col_1">
                <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/ligue1-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('jadwal/index/ligue-1')?>">Ligue 1</a></p>
            </div>
        </div>
        <!-- End 5 columns container -->

    </li>
    <li><a<?=($link_active == "pertandingan") ? ' class="current"' : '' ?> href="#">LIGA</a>
        <div class="dropdown_3columns"><!-- Begin 5 columns container -->

              <div class="col_3">
                  <h2>Silahkan pilih <span style="color:#FF0000">liga</span> yang anda inginkan</h2>
              </div>

              <div class="col_1">
                  <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bpl-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('pertandingan/index/bpl')?>">Inggris</a></p>
              </div>

              <div class="col_1">
                  <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/champions-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('pertandingan/index/champions')?>">Champions</a></p>
              </div>

              <div class="col_1">
                  <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/europa-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('pertandingan/index/europa')?>">Europa</a></p>
              </div>

               <div class="col_1">
                  <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/seriea-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('pertandingan/index/serie-a')?>">Serie A</a></p>
              </div>

                <div class="col_1">
                  <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bundesliga-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('pertandingan/index/bundesliga')?>">Bundesliga</a></p>
              </div>

                <div class="col_1">
                  <p><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/ligue1-flag.png" class="fl" style="margin-right:4px; margin-top:3px"><a href="<?=site_url('pertandingan/index/ligue-1')?>">Ligue 1</a></p>
              </div>
            </div>
    </li>
    </ul>
    </div>
<?php if (empty($sess)) : ?>
    <div id="login-arrow" class="fl">
      <img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/login.png">
    </div>
    <div id="login2" class="fr">
      <ul>
        <li><a href="javascript:;" onclick="login_fb()"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/fb.png"></a></li>
        <li><a href="<?=site_url('twitter/connect')?>?location=<?php echo $loc; ?>"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/twitter.png"></a></li>
        <li><a href="<?php echo site_url('google/connect');?>?location=<?php echo $loc; ?>"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/gplus.png"></a></li>
        </ul>
    </div>
    <div id="membeli">Silahkan Login untuk Membeli </div>
<?php endif ?>
<?php if ($page == 'watch-page') : ?>
  <form method="get" action="/search" id="search" style="float:right">
    <input name="q" type="text" size="40" placeholder="Search..." />
  </form>
<?php endif ?>
<div  class="cb"></div>

</div>
</div>

<div id="container">
  <?php $this->load->view('v2/'.$page); ?>
  <div class="cb"></div>
</div>

<div id="footer-top">
  <div id="footer-top-container">
    <div id="footer-top-content" class="fl">
    <ul>
      <li><a href="<?= site_url('faq') ?>">FAQ</a></li>
      <li><a href="<?= site_url('terms-and-condition') ?>">TERMS & CONDITIONS</a></li>
      <li><a href="<?= site_url('syarat-dan-ketentuan') ?>">SYARAT & KETENTUAN</a></li>
      <li>
        <div class="hover"><a href="">CALL CENTER</a>
          <div class="tooltip">
          Telp: (021) 27935550<br>
        Email: <a href="mailto:kickoff@liputan6.com">kickoff@liputan6.com</a><br>
        Customer Service beroperasi Pukul 09.00-18.00 WIB dan setiap 1 jam sebelum maupun sesudah pertandingan.</div>
        </div>
      </li>
    </ul>
    </div>

    <div class="fl">
      <a href="http://www.nexmedia.co.id/" target="_blank"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/nexmedia.png" style="padding-top:10px; padding-right:20px"></a></div>
    </div>
  </div>
</div>

<div id="footer-bottom">
<div id="footer-bottom-container">

<div id="footer-bottom-content">
  <div id="logo-lip6" class="fl">
    <a href="http://www.liputan6.com/" target="_blank">
      <img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/liputan6-logo.png">
    </a>
  </div>
  <ul>
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
  </ul>
</div>
</div>
</div>
</div>

</div>

<script type="text/javascript">
$('a[href="#"]').click(function(event){
        event.preventDefault();
    });
</script>

</body>
</html>
