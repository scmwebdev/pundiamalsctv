        <!-- s: thank you -->
        <div class="box-ty">
            TERIMAKASIH ANDA TELAH SUKSES MEMBELI PAKET LIVESTREAMING<br>
			
			
        </div>
        
        <script type="text/JavaScript">
			setTimeout("location.href = '<?=site_url('pertandingan')?>';",5000);
		</script>
        <!-- e: thank you -->
        <!--
        <div style="background:#fff;color:#000;padding:20px;">
            <?php
            
            echo '<pre>';
            
            print_r($_POST);
            
            echo '</pre>';
            
            ?>
        </div>
        -->
        
        <!-- s: SCHEDULE -->
        <h1 class="schedule">Match schedule</h1>
        <!--
        <div class="date">
        		<a href="#" class="active">
                        Saturday<br />
                        17 - 08 - 2013
                </a>
                <div class="clearit"></div>
        </div>
        -->
        <table cellpadding="0" cellspacing="0" class="schedule">
        	<tbody>
                <?php foreach ($matches as $key => $match) : ?>
                <tr>
                        <td width="115" align="center"><a class="team-<?php echo $match['team_A_id'] ?>"></a></td>
                        <td width="100" style="font-size: 9px;"><?php echo tgl_indo($match['date_utc']) ?> <br> <b><?php echo $match['time_utc']?> </b ></td>
                        <td><h3><?php echo $match['team_A_name'] ?> <span>vs</span> <?php echo $match['team_B_name'] ?></h3></td>
                        <td width="115" align="center"><a class="team-<?php echo $match['team_B_id'] ?>"></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pb-30"></div><br /><br />
        <!-- e: SCHEDULE -->
