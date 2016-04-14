<?php
  if (isset($link_buy)) {
    $anchor1 = '
      <a href="'.$link_buy.'">
        <img src="'.$this->config->item('ASSETS_LIPUTAN6').'/v2/images/video.jpg">
      </a>';
  } else {
    $anchor1 = '
      <a href="#" onClick="alert(\'Maaf Paket Pertandingan Belum Tersedia\'); return false;">
        <img src="'.$this->config->item('ASSETS_LIPUTAN6').'/v2/images/video.jpg">
      </a>';
  }

  if (isset($is_buyed)) {
    $anchor2 = '
      <a href="#" onClick="alert(\'Maaf pertandingan belum mulai...\'); return false;">
        <img src="'.$this->config->item('ASSETS_LIPUTAN6').'/v2/images/teaser-'.$liga.'.jpg">
      </a>';
  } else {
    if (isset($link_buy)) {
      $anchor2 = '
        <a href="'.$link_buy.'">
          <img src="'.$this->config->item('ASSETS_LIPUTAN6').'/v2/images/teaser-'.$liga.'.jpg">
        </a>';
    } else {
      $anchor2 = '
        <a href="#" onClick="alert(\'Maaf Paket Pertandingan Belum Tersedia\'); return false;">
          <img src="'.$this->config->item('ASSETS_LIPUTAN6').'/v2/images/teaser-'.$liga.'.jpg">
        </a>';
    }
  }
?>

<div id="left-area">
  <div id="box-video">
    <?php
      if (empty($this->sess) or ( $this->sess['id_profile'] == 0 and $this->sess['is_validate'] == '0')) {
        echo $anchor1;
      } else {

        if(empty($is_play)) {
          echo $anchor2;
        } else {
          if ($video_player_type == 1) {
            $this->load->view('pertandingan/player');
          } else {
            $this->load->view('pertandingan/player_flowplayer');
          }
        }

      }
    ?>
  </div>
  <?php if (isset($klasemen)) : ?>
  <div id="title" class="fl">KLASEMEN</div>
  <div id="shared2" class="fr"><?php $this->load->view('v2/social_buttons'); ?></div>
  <div class="cb"></div>
  <div id="line2" style="margin-bottom:7px"></div>


  <div class="menudrop"><a href="javascript:void(0)" onClick="$('#navigation').slideToggle('fast',function(){ if ( $('#navigation').css('display')=='none') {$('#arrowm').attr('src','<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/arrow_downn.png')}else{$('#arrowm').attr('src','<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/arrow_upp.png')}});">Laporan Pertandingan&nbsp;<img id="arrowm" src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/arrow_downn.png" /></a>

  <div id="navigation">
    <div class="content-nav">
      <ul>
        <li><a href="#">Goal</a></li>
        <li><a href="#">Kartu Merah</a></li>
        <li><a href="#">Corner Kick</a></li>
      </ul>
    </div>
  </div>

</div>

<?php $this->load->view('v2/pertandingan/klasemen') ?>

<?php endif ?>

<?php $this->load->view('v2/home/slide_campaign', array('small' => TRUE)); ?>

</div>

<div id="right-area">
  <div id="play-list">
    <div class="isinya">
      <div class="scrollnya">
      <table width="343" border="0" cellspacing="0" cellpadding="0" bgcolor="#45484c">
        <tr>
          <td>
            <table width="343" border="0" cellspacing="1" cellpadding="1">

            <?php if(!empty($listMatchLive)) : foreach($listMatchLive as $k => $v) : ?>

            <?php
            switch($v["media_id"] ) :
              case 0:// Pertandingan belum dimulai ?>
                <tr>
                  <td height="76" bgcolor="#2f2f2f">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="9%" align="center" height="76">&nbsp;</td>
                        <td width="14%" align="center"><a class="team-<?=$v['team_A_id']?>" title="<?=$v['team_A_name']?>"></a></td>
                        <td clas width="61%" align="center" id="white">
                          <table width="100%" border="0" cellspacing="4" cellpadding="0">
                            <tr>
                              <td colspan="3" align="center"><span style="color:#00FF00"><?=local_from_utc($v["date_utc"], $v["time_utc"])->format('d/m/Y &\nb\sp;&\nb\sp; H:i')?></span></td>
                            </tr>
                            <tr>
                              <td width="40%" align="center"><?=$v['team_A_name']?></td>
                              <td width="18%" align="center"><span style="color:#FFFF00">VS</span></td>
                              <td width="42%" align="center"><?=$v['team_B_name']?></td>
                            </tr>
                        </table></td>
                        <td width="16%" align="center"><a class="team-<?=$v['team_B_id']?>" title="<?=$v['team_B_name']?>"></a></td>
                      </tr>
                    </table>
                  </td>
                </tr>
            <?php
                break;
              case -1:// Pertandingan sudah selesai
            ?>

                <tr>
                  <td height="76"  bgcolor="#2f2f2f">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="9%" align="center" height="76"></td>
                        <td width="14%" align="center"><a class="team-<?=$v['team_A_id']?>" title="<?=$v['team_A_name']?>"></a></td>
                        <td clas width="61%" align="center" id="white"><?=$v['team_A_name']?> <span style="color:#FFFF00"><?=$v['fs_A'].' - '.$v['fs_B']?></span> <?=$v['team_B_name']?>
                          <br /><span style="color:#FF0000"> FT</span></td>
                        <td width="16%" align="center"><a class="team-<?=$v['team_B_id']?>" title="<?=$v['team_B_name']?>"></a></td>
                      </tr>
                    </table>
                  </td>
                </tr>
            <?php
                break;
              default:
            ?>
                <tr>
                  <td height="76"  bgcolor="#2f2f2f">
              <?php if (empty($this->sess)) : ?>
                <?php if (isset($link_buy)) : ?>
                  <a href="<?=$link_buy?>">
                <?php else : ?>
                  <a href="#" onClick="alert('Maaf Paket Pertandingan Belum Tersedia'); return false;">
                <?php endif ?>
              <?php else : ?>
                  <a href="<?=site_url('pertandingan/index/'.$liga.'/'.$v['match_id'])?>" match="<?=$v["match_id"]?>" onClick="loadscore_now();">
              <?php endif ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" background="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/bg_list.gif">
                      <tr>
                        <td width="9%" align="center" height="76"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/arrow.png" width="10" height="20" /></td>
                        <td width="14%" align="center"><a class="team-<?=$v['team_A_id']?>" title="<?=$v['team_A_name']?>"></a></td>
                        <td clas width="61%" align="center" id="white"><?=$v['team_A_name']?> <span style="color:#FFFF00"><?=$v['fs_A'].' - '.$v['fs_B']?></span> <?=$v['team_B_name']?>
                          <br /><span style="color:#FF0000">LIVE</span>
                          <br /><span style="color:#FFFFFF">[ PLAY ]</span>
                        </td>
                        <td width="16%" align="center"><a class="team-<?=$v['team_B_id']?>" title="<?=$v['team_B_name']?>"></a></td>
                      </tr>
                    </table>
                  </a>
                  </td>
                </tr>
            <?php
            endswitch ?>

          <?php endforeach; ?>




          <?php elseif (!empty($jadwal)) : ?>

            <?php foreach($jadwal as $k=>$v) : ?>
                <tr>
                  <td height="76" bgcolor="#2f2f2f">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="9%" align="center" height="76">&nbsp;</td>
                        <td width="14%" align="center"><a class="team-<?=$v['team_A_id']?>" title="<?=$v['team_A_name']?>"></a></td>
                        <td clas width="61%" align="center" id="white">
                          <table width="100%" border="0" cellspacing="4" cellpadding="0">
                            <tr>
                              <td colspan="3" align="center"><span style="color:#00FF00"><?=local_from_utc($v["date_utc"], $v["time_utc"])->format('d/m/Y &\nb\sp;&\nb\sp; H:i')?></span></td>
                            </tr>
                            <tr>
                              <td width="40%" align="center"><?=$v['team_A_name']?></td>
                              <td width="18%" align="center"><span style="color:#FFFF00">VS</span></td>
                              <td width="42%" align="center"><?=$v['team_B_name']?></td>
                            </tr>
                        </table></td>
                        <td width="16%" align="center"><a class="team-<?=$v['team_B_id']?>" title="<?=$v['team_B_name']?>"></a></td>
                      </tr>
                    </table>
                  </td>
                </tr>
            <?php endforeach ?>


          <?php endif ?>
          </table>
          </td>
        </tr>
      </table>
      </div>
    </div>
  </div>

  <!-- banner -->
  <div id="mr2"><a href="#"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/v2/images/banner.jpg"></a></div>
  <!-- banner -->


  <div id="title2">HIGHLIGHTS</div>
  <div id="line3"></div>
  <?php if (!empty($highlight)) : ?>
  <div id="hightlights">
    <ul>
    <?php foreach ($highlight as $k=>$v) : ?>
    <li><a href="<?=$v['link']?>"><img src="<?=$v['image']?>" class="fl mr"></a>
      <div class="tanggal"><?=set_tanggal_jam($v['publish_date'])?></div>
      <div class="judul"><a href="<?=$v['link']?>"><?=$v['title']?></a></div><br>
    </li>
    <?php endforeach ?>
    </ul>
    <div class="selengkapnya"><a href="http://video.liputan6.com/main/kategori/70">video lainnya</a></div>
  </div>
  <?php endif ?>

  <?php if (!empty($news)) : ?>
  <div id="title3">KICK-OFF NEWS</div>
  <div id="line3"></div>
  <div id="kickoff">
    <ul>
    <?php foreach ($news as $k=>$v) : ?>
    <li><a href="<?=$v['link']?>"><img src="<?=$v['image']?>" class="fl mr"></a>
      <div class="tanggal"><?=set_tanggal_jam($v['publish_date'])?></div>
      <div class="subtitle"><?=$v['subtitle']?></div>
      <div class="judul"><a href="<?=$v['link']?>"><?=$v['title']?></a></div>
    </li>
    <?php endforeach ?>
    </ul>
    <div class="selengkapnya"><a href="http://bola.liputan6.com/kategori/liga-inggris" target="_blank">berita lainnya</a></div>
  </div>
  <?php endif ?>

</div>
