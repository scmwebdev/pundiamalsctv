<!DOCTYPE html>
<html lang="en">
<head>
<title>Pundi Amal SCTV bersama Teleplan</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url();?>mitra/css/style.css" type="text/css" media="all">

</head>

<body>

<div id="wrapper">
<div id="container">
<div id="top-teleplan"></div>
<div id="content">
<p><?php if(!empty($ambilisi[0]['location'])) {?><img src="<?php echo base_url().'images/'.substr($ambilisi[0]['location'],1);?>" width="700" height="300"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="700" height="300"><?php } ?><br>
                    <?php echo $ambilisi[0]['news']; ?>
	</p>lor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
</div>
<div id="footer-teleplan"></div>
<div class="cb"></div>
</div>
</div>

</body>
</html>
