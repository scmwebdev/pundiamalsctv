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
   	  <div id="logo" class="fl"><a href="<?php echo base_url();?>index.php/show/index"><img src="<?php echo base_url();?>images/logo_pundiamal.png"></a></div>
          <form method="get" action="<?php echo base_url();?>index.php/galeri/searchvideo" id="search" style="width:200px; float:left; margin-left:400px; margin-top:55px">
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
                <a href=""><img src="<?php echo base_url();?>images/slide1.jpg" title="Memberikan Layanan Kesehatan Gratis" /></a>
               <a href=""> <img src="<?php echo base_url();?>images/slide2.jpg" title="Membantu Pengembangan Pendidikan Karakter" /></a>
                <a href=""><img src="<?php echo base_url();?>images/slide3.jpg" title="This is an example of a caption" /></a>
               <a href=""> <img src="<?php echo base_url();?>images/slide4.jpg" title="This is an example of a caption" /></a>
                
                
            </div>
            
        </div>
             </div>
    </div>
    <div id="shadow"></div>
      <div id="runtext" class="fl"><div id="runtext-inside"><marquee><?php echo ucfirst($ticker[0]['ticker']);?></marquee>
</div></div>
    <div id="socmed" class="fr"><a href="https://www.facebook.com/pages/Pundi-Amal-SCTV/465055126923601"><img src="<?php echo base_url();?>images/fb.png"></a><a href="https://twitter.com/pundiamalsctv"><img src="<?php echo base_url();?>images/twitter.png" width="41" height="41"></a><a href="https://www.youtube.com/channel/UC3-aoGEDPP0D5kOcs-_vMGg/videos"><img src="<?php echo base_url();?>images/youtube.png" width="41" height="41"></a></div>
   
    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
    	    <div id="insidepage-content">
               	<div id="insidepage-inside">
                <span style="font-weight:bold; font-size:16px"><?php echo $ambilvideo[0]['title'];?></span>
                  <div id="mediaplayer"></div>
                <script type="text/javascript" src="<?php echo base_url();?>js/jwplayer.js"></script>
	    		<script type="text/javascript">
				jwplayer("mediaplayer").setup({
					'autostart'     : true,
					'image'         : '<?php echo base_url().'images/'.substr($ambilvideo[0]['loc_tpic'],1);?>',
					'file'  		    : '<?php echo base_url().'images/'.substr($ambilvideo[0]['loc_vic'],1);?>',
					'skin'          : '<?php echo base_url();?>skin/slim.zip',
					'flashplayer'   : '<?php echo base_url();?>swf/player510.swf',
					'width'         : '700',
					'height'        : '300',
					'stretching'    : 'uniform',
					'repeat'        : 'list',
														
				});

			</script>
                 <br>
				<?php echo $ambilvideo[0]['news'];?>
                  </div>
                     
                  </div>
          
         <div class="baca-juga" style="margin-top: 0px;">
            <strong>Baca juga:</strong>
            <ul>
                  <?php foreach($baca_juga as $k => $v) :?>
                <li><span style="color:#7777">
                <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
                  <a href="<?php echo base_url('index.php/galeri/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucwords($v['title']);?>
                  </a></li>
                  <?php endforeach;?>
                                            
        </div>
                 
				<div class="cb"></div>
               </div>
                
                
                	</div>
    
        <div id="rightbar-container">
            <div id="title-yellow">
             	<div class="judul">TERBARU</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
        <?php foreach($terbaru as $k => $v):?>
       <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span><br />
          <span style="color:#0478b5; font-weight:bold"><?php echo $v['name'];?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/galeri/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>  
       <?php endforeach; ?> 
      </ul>
     
       
      </div>
       <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/agenda/index_terbaru">Selengkapnya</a></div><br><br />
      </div>
      
      
       <div id="title-yellow">
             	<div class="judul">INFO KEGIATAN</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
      <?php foreach($info_kegiatan as $k => $v):?>
      <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
	  echo $tanggal;
	  ?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/galeri/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?></a></li>
      <?php endforeach;?>
      </ul>
     
       
      </div>
      <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Selengkapnya</a></div><br /><br>
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

