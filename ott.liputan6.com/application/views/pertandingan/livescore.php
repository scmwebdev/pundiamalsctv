<table width="430" cellpadding="0" cellspacing="0">
  <? foreach($listMatchLive as $v): ?>
    <tr id='live-score-<?= $v['match_id'] ?>'>
      <td width="30"><a class="team-<?=$v['team_A_id']?>"></td>
      <td width="150"><?=$v['team_A_name']?></td>
      <td width="50" align="center"><span><?= isset($v['fs_A'])?$v['fs_A']:'0'; ?></span>-<span><?= isset($v['fs_B'])?$v['fs_B']:'0'; ?></span></td>
      <td width="150" align="right"><?=$v['team_B_name']?></td>
      <td width="30"><a class="team-<?=$v['team_B_id']?>"></a></td>
    </tr>
    <tr><td colspan="5"><div class="bb-1"></div></td></tr>
  <? endforeach; ?>
</table>
