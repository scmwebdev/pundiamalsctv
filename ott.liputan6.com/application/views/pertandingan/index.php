<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo isset($page_title)?$page_title.' - ':'' ?>Kick Off</title>
  <link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/css/streaming.css" rel="stylesheet" type="text/css" />
  <link href="<?=$this->config->item('ASSETS_LIPUTAN6')?>/css/big-player.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/js/jquery.182.js"></script>

<!-- start Mixpanel -->
<script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);
b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
mixpanel.init("b9ec3a674650e97e994cc9f0b94e03c1");</script>
<!-- end Mixpanel -->
<script type="text/javascript" language="javascript">
mixpanel.track("View match");
</script>

</head>

<?php isset($uri_match_id)?$uri_match_id = $uri_match_id : $uri_match_id = 0; ?>

<body onload="loadscore();">
  <!-- Piwik -->
<script type="text/javascript">
/*var _paq = _paq || [];
_paq.push(["trackPageView"]);
_paq.push(["enableLinkTracking"]);

(function() {
  var u=(("https:" == document.location.protocol) ? "https" : "http") + "://analytics.kmkonline.co.id/";
  _paq.push(["setTrackerUrl", u+"piwik.php"]);
  _paq.push(["setSiteId", "2"]);
  var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
  g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();*/
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
  <div class="bg-watch">
    <div class="outer_bpl">
      <a class="logo-kickoff-2" href="<?php echo site_url(); ?>" target="_blank"></a>

      <div class="top-bpl">
        <?php $this->load->view('pertandingan/welcome') ?>
        <div class="match">&nbsp;</div>
        <div id="match_id"></div>
        <div class="players">
          <h2>
            <?=!empty($tim_a) ? $tim_a ."<span>VS</span>" : ''?>  <?=!empty($tim_b) ? $tim_b : ''?>

            <?php if ( !empty($tim_a) OR !empty($tim_b) ){ echo '<div style="margin-bottom: 14px"></div>'; } ?>

            <?php $this->load->view('pertandingan/livescore_now') ?>
          </h2>
        </div>
        <div class="other">
          <div class="styled-select">
            <select class="tandinglain">
              <option>Pertandingan Lain</option>
<? if(!empty($listMatchLive)){
  foreach($listMatchLive as $k => $v){
    echo "<option value='".$v['match_id']."'>".$v['team_A_name']." vs ".$v['team_B_name']."</option>";
  }
} ?>
            </select>
          </div>
        </div>
      </div>

      <div class="video-bpl">
      <?php if(empty($tim_a) || empty($tim_a)): ?>
        <img class="placeholder" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/kickoff.jpg" />
      <?php else: ?>
        <?php
        if ($video_player_type == 1) {
          $this->load->view('pertandingan/player');
        } else {
          $this->load->view('pertandingan/player_flowplayer');
        }
        ?>
      <?php endif;?>
      </div>
      <?php $this->load->view('pertandingan/sosmed') ?>

      <? if(!empty($listMatchLive)){
        foreach($listMatchLive as $k => $v){ ?>
          <div id="other-games-<?= $v['match_id'] ?>" class="other-games">
            <table width="150" cellpadding="0" cellspacing="0">
              <tr>
                <td width="50"><a class="team-<?=$v['team_A_id']?>" title="<?=$v['team_A_name']?>"></a></td>
                <td width="50"><?=substr($v['team_A_name'],0,3)?><span>vs</span><?=substr($v['team_B_name'],0,3)?>
                <div style="font-size:10px;margin-top:3px;"><?=local_from_utc($v["date_utc"], $v["time_utc"])->format('d-M-Y')?></div></td>
                <td><a class="team-<?=$v['team_B_id']?>" title="<?=$v['team_B_name']?>"></a></td>
              </tr>
            </table>
            <?php
            switch($v["media_id"] ) {
              case 0:// Pertandingan belum dimulai ?>
                <input disabled type="button" class="btn-play" value="<?=
                  local_from_utc($v["date_utc"], $v["time_utc"])->format("H:i")
                ?>" />
            <?php
                break;
              case -1:// Pertandingan sudah selesai ?>
                <input disabled type="button" class="btn-play" value="<?php echo isset($v["fs_A"])?$v["fs_A"]:''?> : <?php echo isset($v["fs_B"])?$v["fs_B"]:''?> (FT)" style="margin-top:10px;"/>
            <?php
                break;
              default: ?>
                <a href="<?=site_url('pertandingan/play/'.$v['match_id'])?>" match="<?=$v["match_id"]?>" onClick="loadscore_now();"><input type="button" class="btn-play" value="MULAI" /></a>
            <?php
            } ?>
          </div>
        <? }
      } ?>
      <div class="clearit"></div>
    </div>

    <div class="bg-white">
      <div class="outer_bpl pt-20 pb-30">
        <div class="w490 left">
          <span class="title">LIVE SCORE</span>
          <div class="box-results ">
          </div>

          <?php $this->load->view('pertandingan/klasemen') ?>
        </div>
        <div class="w490 right">
          <?php $this->load->view('pertandingan/livereport_temp') ?>
        </div>
        <div class="clearit"></div>
      </div>
    </div>
  </div>

  <div class="modal"><!-- Place at bottom of page --></div>
  <style type="text/css">
    .modal {
      display:    none;
      position:   fixed;
      z-index:    1000;
      top:        0;
      left:       0;
      height:     100%;
      width:      100%;
      background: rgba( 0, 0, 0, .8 )
            url('http://<?=HOST?>assets.liputan6.com/images/ajax-loader.gif')
            50% 50%
            no-repeat;
    }
    body.loading {
      overflow: hidden;
    }
    body.loading .modal {
      display: block;
    }
  </style>
<script type="text/javascript">
  loadscore_now();

  setInterval(function() {
    var match_id = $('#match_id').val();
    var url = "<?=base_url()?>pertandingan/get_match_live/match/"+match_id;
    if(match_id!=""){
      $.ajax({
        type: "POST",
          url: url,
          dataType: "json",
          success: function(data){
            if(data){
              htm = "<h2>"+data.team_A_name+"<span>VS</span>"+data.team_B_name+"</h2><span>"+data.fs_A+"</span>-<span>"+data.fs_B+"</span>"
                $('#livescore').html(htm);
          }else{
            htm = "<h2> - <span>VS</span> - </h2><span>0</span>-<span>0</span>"
              $('#livescore').html(htm);
          }
        }
      })
    }
    loadscore_now();
    loadscore();
    var uri_match_id = <?php echo $uri_match_id; ?>;
    console.log(uri_match_id);
  }, 60000);

  function loadscore(){
    var url_season = "<?=base_url()?>pertandingan/livescore";
    $.ajax({
      type: "POST",
        url: url_season,
        success: function(data){
          if(data){
            $('.box-results').html(data);
        }else{
          $('.box-results').html("");
        }
      }
    })
  }

  function loadscore_now(){
    var url_season = "<?=base_url()?>pertandingan/skor_now/<?=$this->uri->segment(3)?>";
    $.ajax({
      type: "POST",
        url: url_season,
        success: function(data){
          if(data){
            $('.box-results2').html(data);
        }else{
          $('.box-results2').html("");
        }
      }
    })
  }

  $(document).ready(function(){
    $('.tandinglain').change(function(){
      if($('a[match='+$(this).val() +']').length>0)
      {
        window.location=$('a[match='+$(this).val() +']').attr('href');
      }
      else
      {
        alert('Pertandingan belum mulai atau sudah selesai');
      }
    });
  });
</script>

