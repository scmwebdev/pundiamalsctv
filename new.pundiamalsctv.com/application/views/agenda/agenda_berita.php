
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
        	
             <div id="title-insidepage">
             	<div class="judul">AGENDA & BERITA</div>
          </div>
             <div id="insidepage-content">
               	<div id="insidepage-inside">
                  <span style="font-weight:bold; font-size:16px; padding-left:10px"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Info Kegiatan</a></span>
                 <ul>
                <?php foreach($info_kegiatan as $v=>$k):?>
                <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($k['dates']));
				echo $tanggal;?></span>
        <br>
         <?php
				  $slug = url_title($k['title'], 'dash', true);
				  //print_r($slug);
				  ?>
        <a href="<?php echo base_url('index.php/agenda/view/'.$k['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($k['title']));?></a>. </li>
        <?php endforeach;?>
          </ul>  
                 <span style="float:right; padding-right:5px"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan"> Lainnya</a></span>
                 
				 <div class="cb"></div>
                
               
                 <br>
                  
           <div class="calendar2">
          <div id="calendar2"></div>
         </div>
         
         
               </div>
                
                
               
          </div>
          
          <div id="title-insidepage">
             	<div class="judul">KATEGORI BERITA</div>
          </div>
         
         	<div id="insidepage-inside">
<span style="font-weight:bold; font-size:16px; padding-left:10px"><a href="<?php echo base_url();?>index.php/agenda/index_kesehatan">Kesehatan</a></span>

<div id="pilar-inside">
<ul>
<?php foreach($kesehatan as $k=>$v):?>
<li><?php if(!empty($v['location'])) {?><img src="<?php echo base_url() . 'images/' . substr($v['location'],1);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><br><span style="color:#777777">
<?php $tanggal=date("d-m-Y", strtotime($kesehatan[0]['dates']));
 echo $tanggal;?></span><br>
  <?php
 $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
 ?>
 <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug);?>" title="<?php echo ucfirst(strtolower($v['title'])); ?>"><?php echo substr(ucfirst(strtolower($v['title'])),0,40); ?></a></li>
<?php endforeach;?>
</ul>
<span style="float:right; padding-right:15px"><a href="<?php echo base_url()?>index.php/agenda/index_kesehatan">Lainnya</a></span>
</div>
<br>

<span style="font-weight:bold; font-size:16px; padding-left:10px"><a href="<?php echo base_url();?>index.php/agenda/index_lingkungan">Pengembangan Lingkungan</a></span>

<div id="pilar-inside">
<ul>
<?php foreach($lingkungan as $k=>$v):?>
<li><?php if(!empty($v['location'])) {?><img src="<?php echo base_url() . 'images/' . substr($v['location'],1);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><br><span style="color:#777777">
				<?php $tanggal=date("d-m-Y", strtotime($lingkungan[0]['dates']));
                echo $tanggal;?></span><br>
 <?php
 $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
?>
  <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>" title="<?php echo ucfirst(strtolower($v['title']));?>"><?php echo substr(ucfirst(strtolower($v['title'])),0,40); ?></a></li>
<?php endforeach; ?>

</ul>
<span style="float:right ;padding-right:15px"><a href="<?php echo base_url()?>index.php/agenda/index_lingkungan"> Lainnya</a></span>
</div>
<br>

<span style="font-weight:bold; font-size:16px; padding-left:10px"><a href="<?php echo base_url();?>index.php/agenda/index_bencana">Penanganan Bencana</a></span>

<div id="pilar-inside">
<ul>
<?php foreach($bencana as $v => $k):?>
<li><?php if(!empty($k['location'])) {?><img src="<?php echo base_url() . 'images/' . substr($k['location'],1);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><br><span style="color:#777777"><?php $tanggal=date("d-m-Y",strtotime($bencana[0]['dates']));
       echo $tanggal;?></span><br>
        <?php
				  $slug = url_title($k['title'], 'dash', true);
				  //print_r($slug);
				  ?>
  <a href="<?php echo base_url('index.php/agenda/view/'.$k['id'].'/'.$slug); ?>" title="<?php echo ucfirst(strtolower($k['title'])); ?>"><?php echo substr(ucfirst(strtolower($k['title'])),0,40); ?></a></li>
<?php endforeach; ?>
</ul>
<span style="float:right;padding-right:15px"><a href="<?php echo base_url()?>index.php/agenda/index_bencana"> Lainnya</a></span>
</div><br>

<span style="font-weight:bold; font-size:16px; padding-left:10px"><a href="<?php echo base_url();?>index.php/agenda/index_pendidikan">Pendidikan</a></span>

<div id="pilar-inside">
<ul>
<?php foreach($pendidikan as $v=>$k):?>
<li><?php if(!empty($k['location'])) {?><img src="<?php echo base_url() . 'images/' . substr($k['location'],1);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><?php $tanggal=date("d-m-Y",strtotime($pendidikan[0]['dates']));
       echo $tanggal;?></span><br>
        <?php
				  $slug = url_title($k['title'], 'dash', true);
				  //print_r($slug);
		?>
  <a href="<?php echo base_url('index.php/agenda/view/'.$k['id'].'/'.$slug); ?>" title="<?php echo ucfirst(strtolower($k['title'])); ?>"><?php echo substr(ucfirst(strtolower($k['title'])),0,40); ?></a></li>
<?php endforeach; ?>
</ul><span style="float:right;padding-right:15px"><a href="<?php echo base_url()?>index.php/agenda/index_pendidikan">Lainnya</a></span>
</div>
<br>


<span style="font-weight:bold; font-size:16px; padding-left:10px"><a href="<?php echo base_url();?>index.php/agenda/index_berita">Berita</a></span>

<div id="pilar-inside">
<ul>
<?php foreach($berita as $v => $k):?>
<li><?php if(!empty($k['location'])) {?><img src="http://static.pundiamalsctv.com<?php echo($k['location']);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><?php $tanggal=date("d-m-Y",strtotime($berita[0]['dates']));
       echo $tanggal;?></span><br>
   <?php
				  $slug = url_title($k['title'], 'dash', true);
				  //print_r($slug);
				  ?>
  <a href="<?php echo base_url('index.php/agenda/view/'.$k['id'].'/'.$slug); ?>" title="<?php echo ucfirst(strtolower($k['title'])); ?>"><?php echo substr(ucfirst(strtolower($k['title'])),0,40); ?></a></li>
<?php endforeach; ?>

</ul><span style="float:right;padding-right:15px"><a href="<?php echo base_url()?>index.php/agenda/index_berita"> Lainnya</a></span>
</div>
<br>


</div>
          	</div>
    
        <div id="rightbar-container">
        	
             <div id="title-yellow">
             	<div class="judul"><a href="<?php echo base_url();?>index.php/penyumbang/index">DAFTAR PENYUMBANG</a></div>
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


    
        </div>
        
       <div class="selengkapnya" style="padding-right:10px"><a href="<?php echo base_url('index.php/penyumbang/index');?>">Selengkapnya</a></div><br><br>
        
              <div><span style="font-weight:bold">NOMOR REKENING PUNDI AMAL SCTV</span>
BCA : 084 266 2000 <br /> KCU WISMA ASIA, SLIPI </div><br>
        
        <div id="title-yellow">
             	<div class="judul">TESTIMONI</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
       <?php foreach($testimoni as $k => $v ):?>
      <li><span style="color:#777777">
	  <?php $tanggal=date("d-m-Y", strtotime($v['dates']));
		echo $tanggal;?></span>
        <br>
         <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
		?>
      <a href="<?php echo base_url('index.php/testimoni/view/'.$v['id_berita'].'/'.$slug);?>"> <?php echo ucfirst(strtolower($v['title']));?> </a></li>
         <?php endforeach;?>
      </ul>
      
       
      </div>
      <div class="selengkapnya" style="padding-right:10px"><a href="<?php echo base_url();?>index.php/testimoni/index">Selengkapnya</a></div><br><br>
      <div id="title-yellow">
             	<div class="judul"><a href="<?php echo base_url();?>index.php/galeri/galery_foto">FOTO</a></div>
          </div>
          <div id="left-content">
           	<?php foreach($foto as $k=>$v):?>
               	<div id="left-content-inside1">
                   <a href="<?php echo base_url('index.php/galeri/view_foto/'.$v['id'].'/'.$slug);?>" title="<?php echo $v['title'];?>"> 
				<?php if(!empty($v['location'])) {?><img src="<?php echo base_url() . 'images/' . substr($v['location'],1);?>"width="210px" height="133px"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="210px" height="133px"><?php } ?>
				
                 <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
            
			   <?php 
				  $string=ucfirst(strtolower($v['title']));
				  $h=explode(" ",$string);
				  $hasil=implode(" ", array_splice($h, 0, 10));
				  echo $hasil;
			   ?></a></div>
               <div class="horizontal1"></div>
               <?php endforeach; ?>
              
      <div class="cb"></div>
      </div>
       <div class="selengkapnya" style="padding-right:25px"><a href="<?php echo base_url();?>index.php/galeri/galery_foto">Selengkapnya</a></div><br><br>
      <div id="title-yellow">
             	<div class="judul"><a href="<?php echo base_url();?>index.php/galeri/galery_video">VIDEO</a></div>
             </div>
             <div id="left-content">
                <?php foreach($video as $k=>$v):?>
               	<div id="left-content-inside1">
                <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
            <a href="<?php echo base_url('index.php/galeri/view_video/'.$v['id'].'/'.$slug ); ?>" title="<?php echo $v['title'];?>"><div id="play-btn-small"></div>
			<?php if(empty($v['loc_tpic'])){?>
                   <img src="<?php echo site_url();?>images/pundi-amal.jpg" width="218" height="124">
                <?php } else{ ?>
                <img src="<?php echo base_url('images/'.substr($v['loc_tpic'],1)); ?>" width="218" height="124">
                <?php } ?></a>
             <?php 
				  $string=ucfirst(strtolower($v['title']));
				  $h=explode(" ",$string);
				  $hasil=implode(" ", array_splice($h, 0, 10));
				  
			?> 
             <a href="<?php echo base_url('index.php/galeri/view_video/'.$v['id'].'/'.$slug ); ?>" title="<?php echo $v['title'];?>"><?php echo $hasil;?></a>
            </div>
               <div class="horizontal1"></div>
               <?php endforeach; ?>
              <div class="selengkapnya" style="padding-right:25px"><a href="<?php echo base_url();?>index.php/galeri/galery_video">Selengkapnya</a></div>
                   
               <div class="cb"></div>
          </div>
        
        
        
        
    </div>
    
    
    
        </div>
        <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

