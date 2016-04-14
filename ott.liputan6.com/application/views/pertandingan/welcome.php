<?php
$uri = $this->uri->uri_string();
!empty($uri)?$loc = $uri : $loc = 'home';
if (!isset($link_active)) $link_active = 'home';
?>

<!-- s: welcome user -->
<div class="welcome">
	<ul class="nav-lip6">
		<li>
			<a href="http://www.liputan6.com" target="_blank">
				<img src="<?=$this->config->item('ASSETS_LIPUTAN6')?>/images/logo-liputan6.png" width="107" height="29" alt="" />
			</a>
			<div class="sub-nav-wrapper2">
				<ul class="sub-nav">
					<li><a href="http://news.liputan6.com" target="_blank">News</a></li>
					<li><a href="http://bisnis.liputan6.com" target="_blank">Bisnis</a></li>
					<li><a href="http://bola.liputan6.com" target="_blank">Bola</a></li>
					<li><a href="http://showbiz.liputan6.com" target="_blank">Showbiz</a></li>
					<li><a href="http://tekno.liputan6.com" target="_blank">Tekno</a></li>
					<li><a href="http://health.liputan6.com" target="_blank">Health</a></li>
					<li><a href="http://foto.liputan6.com" target="_blank">Foto</a></li>
					<li><a href="http://video.liputan6.com" target="_blank">Video</a></li>
					<li><a href="http://video.liputan6.com/streaming" target="_blank">Streaming</a></li>
					<li><a href="http://deal.liputan6.com" target="_blank">Deal</a></li>
					<li><a href="http://liputan6.com/indeks/terkini" target="_blank">Index</a></li>
				</ul>
			</div>
		</li>
	</ul>
	<?php if (empty($sess)) { ?>
		<div class="user-login">
			<a class="login-g right ml-5" href="<?php echo site_url('google/connect');?>?location=<?php echo $loc; ?>"></a>
			<a class="login-tw right ml-5" href="<?=site_url('twitter/connect')?>?location=<?php echo $loc; ?>"></a>
			<a class="login-fb right ml-5" href="javascript:;" onclick="login_fb()"></a>
			<div class="clearit"></div>
		</div>
	<?php } else { ?>
		Welcome, <span><?=$sess['full_name']?></span>  <a href="<?=site_url('logout')?>"><input class="logout" type="submit" value="Logout" /></a>
	<?php } ?>
</div>
<!-- e: welcome user -->

<!-- s: nav -->
<div class="menu">
	<a <?php if($link_active == "home") { echo 'class="active"'; } ?> href="<?php echo base_url();?>">HOME</a>
	<a <?php if($link_active == "jadwal") { echo 'class="active"'; } ?> href="<?php echo site_url('jadwal');?>">JADWAL</a>
	<a <?php if($link_active == "pertandingan") { echo 'class="active" '; } ?>href="<?php echo site_url('pertandingan');?>">PERTANDINGAN LIVE</a>
	<?php if (!empty($sess) && $sess['id_profile'] > 0 && $sess['is_validate'] == '1') :?>
		<a <?php if($link_active == "profil") { echo 'class="active"'; } ?>href="<?php echo site_url('profil');?>">PROFIL</a>
	<?php endif;?>
	<div class="clearit"></div>
</div>
<!-- e: nav -->
