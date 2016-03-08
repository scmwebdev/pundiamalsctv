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
      <div id="runtext" class="fl"><div id="runtext-inside"><marquee><?php echo ucfirst($ticker[0]['ticker']);?></marquee>
</div></div>
    <div id="socmed" class="fr"><a href="https://www.facebook.com/pages/Pundi-Amal-SCTV/465055126923601"><img src="<?php echo base_url();?>images/fb.png"></a><a href="https://twitter.com/pundiamalsctv"><img src="<?php echo base_url();?>images/twitter.png" width="41" height="41"></a><a href="https://www.youtube.com/channel/UC3-aoGEDPP0D5kOcs-_vMGg/videos"><img src="<?php echo base_url();?>images/youtube.png" width="41" height="41"></a></div>
   
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
        	
             <div id="title-insidepage">
             	<div class="judul">VIDEO</div>
          </div>
          <div id="insidepage-content">
               	<div id="insidepage-inside">
                  
         <div id="pilar-inside">
<ul>
<?php foreach($video as $v=>$k):?>
<li>
<?php
$slug = url_title($k['title'], 'dash', true);
?>
 <a href="<?php echo base_url('index.php/galeri/view_video/'.$k['id'].'/'.$slug); ?>">
<?php if(!empty($k['loc_tpic'])) {?><img src="http://static.pundiamalsctv.com<?php echo($k['loc_tpic']);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><br><span style="color:#3300FF"><?php $tanggal=date("d-m-Y", strtotime($k['dates']));
echo $tanggal;?></span><br>
<?php  echo ucfirst(strtolower($k['title']));?>
</a>
</li>
<?php endforeach;?>
</ul>

</div>
<ul id="paging" class="fr">
         <?php echo $this->pagination->create_links();?> 
  </ul>
<br>
          </div>            
          </div>
         	
          	</div>
    
        <div id="rightbar-container">
        	
             <div id="title-yellow">
             	<div class="judul">DAFTAR PENYUMBANG</div>
          </div>
             <div id="left-content">
               	
<table width="250" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>No</strong></div></td>
    <td width="120" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>Nama</strong></div></td>
    <td width="88" height="30px" bgcolor="#9c9c9c"><div align="center"><strong>Jumlah</strong> (Rp)</div></td>
  </tr>
</table>
<table width="250" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" bgcolor="#9c9c9c"><table width="250" border="0" cellspacing="1" cellpadding="4">
      <?php $nourut = 0;?>
    <?php foreach($penyumbang as $k => $v ):?>
    <?php $nourut++; ?>
      <tr>
        <td width="37" bgcolor="#e9e9e9"><?php echo $nourut;?></td>
        <td width="123" bgcolor="#e9e9e9"><?php echo ucfirst(strtolower($v['nama']));?></td>
        <td width="80" bgcolor="#e9e9e9"><?php echo number_format($v['jumlah'],2,",",".") ;?></td>
      </tr>
      <?php endforeach;?>
    </table></td>
  </tr>
</table>
 <div class="selengkapnya mr30"><a href="<?php echo base_url('index.php/penyumbang/index')?>">Selengkapnya</a></div><br><br>

    
        </div>
        
       
        
        <div id="title-yellow">
             	<div class="judul">TERBARU</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
     <?php foreach($terbaru as $k => $v):?>
       <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span>
          <br>
      <span style="color:#0478b5; font-weight:bold"><?php echo $v['name'];?></span>
        <br><br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucwords($v['title']);?>. </a></li>  
       <?php endforeach; ?>
      
      </ul>
      
       
      </div>
      <div class="selengkapnya mr30"><a href="<?php echo base_url('index.php/agenda/index_berita')?>">Selengkapnya</a></div><br><br>
      </div>
      
      
       <div id="title-yellow">
             	<div class="judul">INFO KEGIATAN</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
       <?php foreach($info_kegiatan as $k => $v):?>
      <li>
        <?php
		$slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
		?>
       <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug);?>">
      <span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
	  echo $tanggal;
	  ?></span>
        <br>
     
      <?php  echo ucfirst(strtolower($v['title']));?>. 
      </a>
      </li>
      <?php endforeach;?>
      
      </ul>
      
       
      </div>
      <div class="selengkapnya mr30"><a href="<?php echo base_url('index.php/agenda/info_kegiatan')?>">Selengkapnya</a></div><br><br>
      </div>
        </div>
        <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

