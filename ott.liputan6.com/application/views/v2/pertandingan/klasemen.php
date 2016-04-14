<style>
.style1 {
  font-size: 15px;
  font-weight: bold;
  text-transform: uppercase;
}
.gray td { background: gray;}
</style>
<? /*
<select name="combo_liga" id="combo_liga" style="float:right; margin-top:0px; margin-bottom:15px">
  <option value="">Liga Inggris</option>
  <option value="">Liga Itali</option>
  <option value="">Liga Jerman</option>
  <option value="">Liga Prancis</option>
</select>
*/?>
<div style="padding:10px 0"></div>
<div id="table-klasemen" class="fl">
  <?php if(!empty($klasemen)) : ?>

  <?php if (in_array($season_id, array('8381','8295'))) : ?>

  <?php foreach ($klasemen as $group => $groups) : ?>

    <table width="640" border="0" cellspacing="0" cellpadding="0" style="border:#ccc 1px solid; margin-bottom:20px;">
      <tr>
        <td colspan="8"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="gray">
          <tr>
            <td width="41%"><span class="style1"><?=$group?></span></td>
            <td width="11%" align="center"><span class="style1">Main</span></td>
            <td width="8%" align="center"><span class="style1">M</span></td>
            <td width="8%" align="center"><span class="style1">S</span></td>
            <td width="10%" align="center"><span class="style1">K</span></td>
            <td width="10%" align="center"><span class="style1">SG</span></td>
            <td width="12%" align="center"><span class="style1">POIN</span></td>
          </tr>
        </table></td>
      </tr>
      <?php $i=0; foreach ($groups as $key => $val) : $i++;?>
      <tr<?=($i%2) == 0 ? '' : ' bgcolor="#e7e7e7"'?>>
        <td width="33" align="right" style="padding:6px"><?=$i?>.</td>
        <td width="230" style="padding:6px"><?php echo $val['club_name']; ?></td>
        <td width="75" align="center" style="padding:6px"><?php echo $val['matches_total']; ?></td>
        <td width="53" align="center" style="padding:6px"><?php echo $val['matches_won']; ?></td>
        <td width="48" align="center" style="padding:6px"><?php echo $val['matches_draw']; ?></td>
        <td width="59" align="center" style="padding:6px"><?php echo $val['matches_lost']; ?></td>
        <td width="66" align="center" style="padding:6px"><?php echo $val['goals_against']; ?></td>
        <td width="76" align="center" style="padding:6px"><?php echo $val['points']; ?></td>
      </tr>
      <?php endforeach ?>
    </table>

  <?php endforeach ?>

<?php else : ?>

  <table width="640" border="0" cellspacing="0" cellpadding="0" style="border:#ccc 1px solid;">
    <tr>
      <td colspan="8"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="gray">
        <tr>
          <td width="41%"><span class="style1"><?=$title_liga?></span></td>
          <td width="11%" align="center"><span class="style1">Main</span></td>
          <td width="8%" align="center"><span class="style1">M</span></td>
          <td width="8%" align="center"><span class="style1">S</span></td>
          <td width="10%" align="center"><span class="style1">K</span></td>
          <td width="10%" align="center"><span class="style1">SG</span></td>
          <td width="12%" align="center"><span class="style1">POIN</span></td>
        </tr>
      </table></td>
    </tr>
    <?php $i=0; foreach ($klasemen as $key => $val) : $i++;?>
    <tr<?=($i%2) == 0 ? '' : ' bgcolor="#e7e7e7"'?>>
      <td width="33" align="right" style="padding:6px"><?=$i?>.</td>
      <td width="230" style="padding:6px"><?php echo $val['club_name']; ?></td>
      <td width="75" align="center" style="padding:6px"><?php echo $val['matches_total']; ?></td>
      <td width="53" align="center" style="padding:6px"><?php echo $val['matches_won']; ?></td>
      <td width="48" align="center" style="padding:6px"><?php echo $val['matches_draw']; ?></td>
      <td width="59" align="center" style="padding:6px"><?php echo $val['matches_lost']; ?></td>
      <td width="66" align="center" style="padding:6px"><?php echo $val['goals_against']; ?></td>
      <td width="76" align="center" style="padding:6px"><?php echo $val['points']; ?></td>
    </tr>
  <?php endforeach ?>
  </table>

<?php endif ?>

<?php endif ?>

</div>
