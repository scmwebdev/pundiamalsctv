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
