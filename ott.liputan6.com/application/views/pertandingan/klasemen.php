<!-- s: KLASEMEN -->
<?php if(!empty($klasemen)) { ?>
<span class="title-2">BPL KLASEMEN</span>
<div class="box-klasemen ">
	<table width="430" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" class="bg-lightblue" width="35"><b>No.</b></td>
			<td class="bg-lightblue"><b>Team</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Match"><b>M</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Win"><b>W</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Draw"><b>D</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Lose"><b>L</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Goal Pro"><b>GP</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Goal Againts"><b>GA</b></td>
			<td align="center" class="bg-lightblue" width="35" title="Points"><b>Pts</b></td>
		</tr>
		<?php
		if(!empty($klasemen) AND isset($klasemen)) {
		foreach ($klasemen as $key => $klasemens) { ?>
			<tr>
					<td align="center"><?php echo $klasemens['rank']; ?>.</td>
					<td><?php echo $klasemens['club_name']; ?> </td>
					<td align="center" title="Match"><?php echo $klasemens['matches_total']; ?></td>
					<td align="center" title="Win"><?php echo $klasemens['matches_won']; ?></td>
					<td align="center" title="Draw"><?php echo $klasemens['matches_draw']; ?></td>
					<td align="center" title="Lose"><?php echo $klasemens['matches_lost']; ?></td>
					<td align="center" title="Goal Pro"><?php echo $klasemens['goals_pro']; ?></td>
					<td align="center" title="Goal Againts"><?php echo $klasemens['goals_against']; ?></td>
					<td align="center" title="Points"><?php echo $klasemens['points']; ?></td>
			</tr>
			<tr><td colspan="9"><div class="bb-1"></div></td></tr>
	   <?php }
	   	}
	    ?>
	</table>
</div>
<!-- e: KLASEMEN -->
<?php } ?>