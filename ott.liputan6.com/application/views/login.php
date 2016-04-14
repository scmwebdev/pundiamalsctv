<div class="regis">
	<h1 class="t-regis"><?php echo empty($sess) ? "login" : "registrasi"?></h1>
    <p class="intro"><!-- Silahkan lengkapi registrasi. --></p>

<?php
#$campaign_id = $campaign[0]['campaign_id'];

if (empty($sess)) {
?>	
    <!-- s: register step -->
    <div class="box-register bg-grad-1">
    		<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-regis-1.png" width="940" height="6" alt="" />
    		<h2> <?php echo empty($sess) ? "login" : "registrasi"?></h2>
            <div class="clearit"></div>
            <table width="900" cellpadding="0" cellspacing="0">
            	<tr>
                    <td width="280">
                    		<h3>Login Facebook</h3>
                            <p>Connect your account to Facebook</p>
                            <a class="login-fb" href="javascript:;" onclick="login_fb()"></a>
                    </td>
                	<td width="30"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-or.png" width="20" height="97" alt="" /></td>
                	<td width="280">
                    		<h3>Login Twitter</h3>
                            <p>Connect your account to Twitter</p>
                            <a class="login-tw" href="<?=site_url('twitter/connect').'?location='.$this->uri->uri_string()?>"></a>
                    </td>
                	<td width="30"><img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/list-or.png" width="20" height="97" alt="" /></td>
                	<td width="280">
                    		<h3>Login Google+</h3>
                            <p>Connect your account to Google Plus</p>
                            <a class="login-g" href="<?=site_url('google/connect').'?location='.$this->uri->uri_string()?>"></a>
                    </td>
                </tr>
            </table>
    </div>
    <!-- e: register step -->
	
<?php	
} else { redirect();}
?>
