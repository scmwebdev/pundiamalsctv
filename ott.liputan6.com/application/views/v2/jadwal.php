<?php /*
<div id="title4">Jadwal Pertandingan <?=$title_jadwal?></div>
<div id="jadwal">
  <div class="tabbing">
    <ul id="tabbing_tabs" class="shadetabs">
      <? foreach ($matches_by_date as $date => $matches): ?>
        <li><a href="#" rel="tab<?= $date ?>"><?php echo tgl_indo($date, true) ?></a></li>
      <? endforeach; ?>
    </ul>

    <? foreach ($matches_by_date as $date => $matches): ?>
      <div id="tab<?= $date ?>" class="tabcontent">
        <table cellpadding="0" cellspacing="0" class="schedule">
          <tbody>
            <?php foreach ($matches as $match) : ?>
              <tr data-match_id="<?= $match['match_id'] ?>">
                <td align="center" width="100"><?= local_from_utc($match['date_utc'], $match['time_utc'])->format('H:i:s') ?></td>
                <td width="115" align="center"><a class="team-<?php echo $match['team_A_id'] ?>"></a></td>
                <td width="200" align="right"><h3><?php echo $match['team_A_name']?></h3></td>
                <td width="10" align="center"><span>vs</span></td>
                <td width="200" align="left"><h3><?php echo $match['team_B_name']?></h3></td>
                <td width="115" align="center"><a class="team-<?php echo $match['team_B_id'] ?>"></a></td>
              </tr>
            <? endforeach; ?>
          </tbody>
        </table>
      </div>
    <? endforeach; ?>

    <script type="text/javascript">
      var countries=new ddtabcontent("tabbing_tabs");
      countries.setpersist(true);
      countries.setselectedClassTarget("link"); //"link" or "linkparent"
      countries.init();
    </script>
  </div>
  <!-- redesign -->

  <? if(isset($campaign[0]['key']) AND !empty($campaign[0]['key'])): ?>
    <div class="pb-30" align="center">
      <a class="buy2" href="<?=site_url('campaign/'.$campaign[0]['key'].'/buy')?>"></a>
    </div>
  <? endif; ?>
  <br/><br />
  <!-- e: SCHEDULE -->
</div>
*/ ?>

<div id="title4">Jadwal Pertandingan <?=$title_jadwal?></div>

<div id="jadwal">
  <table width="900" border="0" cellspacing="0" cellpadding="0">

  <?php
  $i=0;
  foreach ($matches_by_date as $date => $matches):

    $hari  = getHari(date("l", strtotime($date)));
    $bulan = getBulan(substr($date,5,2));
    $tgl   = substr($date,8,2);
    $tahun = substr($date,0,4);


    $date1=$date;
    foreach ($matches as $match) :
      $i++;
  ?>

  <tr data-match_id="<?= $match['match_id'] ?>" bgcolor="<?=$i%2==0?'#f3f3f3':'#e7e7e7'?>">
    <td width="101" style="padding:6px">
      <?php if ($date == $date1 ) : ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px #b8b8b8 solid">
      <tr>
        <td bgcolor="#CCCCCC">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" bgcolor="#FFFFFF"><?=$hari?></td>
            </tr>
            <tr>
              <td align="center" bgcolor="#33CC00" class="date-jadwal"><?=$tgl?></td>
            </tr>
            <tr>
              <td align="center"><?=$bulan?></td>
            </tr>
            <tr>
              <td align="center"><?=$tahun?></td>
            </tr>
          </table>
        </td>
      </tr>
      </table>
      <?php $date1=0; endif ?>

    </td>
    <td width="140" align="center" style="padding:6px"><?= local_from_utc($match['date_utc'], $match['time_utc'])->format('H:i:s') ?></td>
    <td width="41" align="center" style="padding:6px"><a class="team-<?php echo $match['team_A_id'] ?>"></a></td>
    <td width="227" align="center" style="padding:6px"><?php echo $match['team_A_name']?></td>
    <td width="45" align="center" style="padding:6px">VS</td>
    <td width="243" align="center" style="padding:6px"><?php echo $match['team_B_name']?></td>
    <td width="103" align="center" style="padding:6px"><a class="team-<?php echo $match['team_B_id'] ?>"></a></td>
  </tr>

  <?php endforeach; endforeach ?>
  </table>
</div>