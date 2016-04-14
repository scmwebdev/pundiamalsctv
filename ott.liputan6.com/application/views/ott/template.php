<?php 
$uri = $this->uri->uri_string();
!empty($uri)?$loc = $uri : $loc = 'home';
?>

<?php echo isset($header)?$header : "";  ?>

<body>
<div class="bpl-index">
        <?php echo isset($nav)?$nav : "";  ?>
        
       

<div class="outer_bpl">        
		
        <div class="user-login">
                <a class="login-g right ml-5" href="<?php echo site_url('google/connect');?>?location=<?php echo $loc; ?>"></a>
                <a class="login-tw right ml-5" href="<?=site_url('twitter/connect')?>?location=<?php echo $loc; ?>"></a>
                <a class="login-fb right ml-5" href="<?=site_url('fbconnect/login')?>"></a>
                <div class="clearit"></div>
        </div>
        <!-- s: after login -->
        <!-- 
		<div class="user-login">
        		Welcome, <span>Stephen S.</span> <input class="logout" type="submit" value="Logout" />
        </div>
        -->
		<!-- e: after login -->
        
		<a class="logo-bpl mt-5 ml-100" href="<?php echo site_url(); ?>"></a>
        <h1 class="title">the battle begins!!!</h1>
        <h1 class="title-2">Watch BPL anytime, anywhere. </h1>
        
        <?php echo isset($content)?$content : "";  ?>
</div>

<?php echo isset($footer)?$footer : "";  ?>

</body>
</html>
