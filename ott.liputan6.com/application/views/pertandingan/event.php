<? if (!empty($liveReport)) { ?>
  <table width="430" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" class="bg-lightblue" width="40"><b>Sec</b></td>
      <!-- <td class="bg-lightblue" width="60" align="center"><b>Score</b></td> -->
      <td align="center" class="bg-lightblue" width="40"><b>Team</b></td>
      <td align="center" class="bg-lightblue" width="50"><b>Act</b></td>
      <td class="bg-lightblue"><b>Player</b></td>
    </tr>
    <? foreach($liveReport as $k => $v){ ?>
      <? switch ($v['code']) {
        case 'G':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-goal.png";
          break;
        case 'PG':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-penalti.png";
          break;
        case 'SO':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-out.png";
          break;
        case 'SI':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-in.png";
          break;
        case 'YC':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-yellowcard.png";
          break;
        case 'RC':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-redcard.png";
          break;
        case 'AS':
          $icon = $this->config->item('ASSETS_LIPUTAN6')."/images/ico-assist.png";
      } ?>
      <tr>
        <td align="center"><?php echo $v['minute']."'"?></td>
        <td align="center"><a class="team-<?php echo $v['team_id']; ?>" title="<?php echo $v['short_name']?>"></a></td>
        <td align="center">
          <img src="<?php echo $icon?>" width="16" height="15" alt="" title="<?php echo $v['name']?>" />
        </td>
        <td><?php echo $v['person']?></td>
      </tr>
      <tr><td colspan="7"><div class="bb-1"></div></td></tr>
    <? } ?>
  </table>
<? } ?>

