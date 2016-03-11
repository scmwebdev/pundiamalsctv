<!DOCTYPE html>
<html lang="en">
<head>
<title>Pundi Amal SCTV bersama XL</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url()?>mitra/css/style.css" type="text/css" media="all">
<title>Pundi Amal SCTV bersama XL</title>
</head>

<body>

<div id="wrapper">
<div id="container">
<div id="top-xl"></div>
<div id="content">
    <p><?php if(!empty($ambilisi[0]['location'])) {?><img src="http://static.pundiamalsctv.com<?php echo $ambilisi[0]['location'];?>" width="700" height="300"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="700" height="300"><?php } ?><br>
                    <?php echo $ambilisi[0]['news']; ?>
	</p>
</div>
<div id="footer-xl"></div>
<div class="cb"></div>
</div>
</div>

</body>
</html>
