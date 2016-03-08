<!DOCTYPE html>
<html lang="en">
<head>
<title>Pundi Amal SCTV</title>
<meta charset="utf-8">
  
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo base_url();?>css/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>css/stylenivo.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>css/slidehl.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/paging.css" type="text/css" media="all">


<link href="<?php echo base_url();?>css/fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url();?>css/fullcalendar.print.css" rel="stylesheet" media="print" />
<script src="<?php echo base_url();?>jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>jquery/jquery-ui-1.10.2.custom.min.js"></script>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery.carouFredSel-6.1.0-packed.js"></script>
<script type="text/javascript" language="javascript">
			$(function() {	
				//	Variable number of visible items with variable sizes
						$('#foo3').carouFredSel({
							width: 700,
							height: 'auto',
							prev: '#prev3',
							next: '#next3',
							auto: 'play',
							circular: true,
							infinite: false
						});
			});
			
		 function showPreview(imagePath,imageIndex){
			var subImages = document.getElementById('insidepage-inside').getElementsByTagName('IMG');
			if(subImages.length==0){
			var img = document.createElement('IMG');
			document.getElementById('insidepage-inside').appendChild(img);
		
			}else img = subImages[0];
			/*
			if(displayWaitMessage){
			document.getElementById('waitMessage').style.display='inline';
			}
			document.getElementById('largeImageCaption').style.display='none';
			img.onload = function() { hideWaitMessageAndShowCaption(imageIndex-1); };*/
			img.src = imagePath;
			img.border=0;
    }
</script>

    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/anylinkcssmenu.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/anylinkcssmenu.js"></script>

<script type="text/javascript">
//anylinkcssmenu.init("menu_anchors_class") ////Pass in the CSS class of anchor links (that contain a sub menu)
anylinkcssmenu.init("anchorclass")
</script>


<style type="text/css">
<!--
.style1 {color: #0166a1}
-->
</style></head>

<body>

<div id="wrapper">
  <div id="container">
    <div id="top">
   	  <div id="logo" class="fl"><a href="<?php echo base_url();?>index.php/home/index"><img src="<?php echo base_url();?>images/logo_pundiamal.png"></a></div>
          <form method="get" action="<?php echo base_url();?>index.php/galeri/search_gallery" id="search" style="width:200px; float:left; margin-left:400px; margin-top:55px">
            <input name="search" id="search" type="text" size="40" placeholder="Search..." />
          </form>
          <div id="logo-sctv" class="fr" style="padding-top:16px; padding-right:10px"><a href="http://www.sctv.co.id" target="_blank"><img src="<?php echo base_url();?>images/logo-sctv.png"></a></div>
            
          <div id="menu" class="fl">
              <div id="menu-atas">
                <ul>
                 <li><a href="<?php echo base_url();?>index.php/home/index">HOME</a></li>
               <li><a href="<?php echo base_url();?>index.php/profil/index">PROFIL</a></li>
                <li><a href="<?php echo base_url();?>index.php/agenda/index">AGENDA & BERITA</a></li>
                <li><a class="current" href="<?php echo base_url();?>index.php/galeri/index">GALERI</a></li>
                <li><a href="<?php echo base_url();?>index.php/penyumbang/index">DAFTAR PENYUMBANG</a></li>
                <li><a href="<?php echo base_url();?>index.php/testimoni/index">TESTIMONI</a></li>
                <li><a href="<?php echo base_url();?>index.php/mitra/index">MITRA</a></li>
                </ul>
              </div>
      </div>
    </div>
        
    <div id="header">
    	<div id="header-inside">   
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
			<?php if (is_array($headlines)){?>
			<?php foreach($headlines as $k=>$v):?>
            <a href=""><img src="http://static.pundiamalsctv.com/<?php echo $v['location'];?>" title="<?php echo $v['caption'];?>"/></a>   
            <?php endforeach;?>   
            <?php } ?> 
            </div>
            
        </div>
        </div>
    </div>
    <div id="shadow"></div>
       <div id="runtext" class="fl"><div id="runtext-inside"><marquee><?php 
	echo"Terima Kasih Kepada : ";
	foreach ($ticker_atas as $k=>$v)
	{
		echo strip_tags($v['nama']).",".$v['jumlah'].",".strip_tags($v['tanggal'])." | ";
		for($i=0;$i<10; $i++) echo "&nbsp;";
	}
	//htmlspecialchars($ticker[0]['ticker']);?></marquee></div></div>
    <div id="socmed" class="fr"><a href="https://www.facebook.com/pages/Pundi-Amal-SCTV/465055126923601" target="_blank"><img src="<?php echo base_url();?>images/fb.png"></a><a href="https://twitter.com/pundiamalsctv" target="_blank"><img src="<?php echo base_url();?>images/twitter.png" width="41" height="41"></a><a href="https://www.youtube.com/channel/UC3-aoGEDPP0D5kOcs-_vMGg/videos" target="_blank"><img src="<?php echo base_url();?>images/youtube.png" width="41" height="41"></a></div>