<div class="regis">
	<h1 class="t-regis"><?php echo empty($sess) ? "login" : "registrasi"?></h1>
    <p class="intro"><!-- Silahkan lengkapi registrasi. --></p>

<?php #die(print_r($campaign));?>
    <!-- s: register step -->
    <div class="box-register bg-grad-1">
    		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-regis-1.png" width="940" height="6" alt="" />
    		<h2> <?php echo empty($sess) ? "login" : "registrasi"?></h2>
            <div class="clearit"></div>
            
            <table width="900" cellpadding="0" cellspacing="0">
            	<tr>
                    <td width="280">
                    		<p style="color:black;font-size:14px;"><?=$content?></p>
                    		<br/>
                    		<p style="color:black;font-size:14px;">
								<table border=0>									
								<?php 
									$i=1; foreach($campaign as $k => $v):
									if ($i++ > 1) break;
								?>
									<tr>
									<td>
										<a href="<?=site_url('campaign/'.$v['key'].'/buy')?>" style="text-decoration:none;">
											<input type="submit" value="Beli Sekarang" class="logout" style="font-size:25px;">									
										</a>
										
									</td>						
									</tr>
								<?php endforeach;?>								
								</table>
									
								
                    		</p>
                    </td>
                </tr>
            </table>
           
    </div>
    <!-- e: register step -->
	
<?php	

?>
