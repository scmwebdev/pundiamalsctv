
    <div id="content" class="fl">
    	<div id="leftbar-container" class="fl">
        	
             <div id="title-yellow">
             	<div class="judul">EMPAT PILAR PUNDI AMAL SCTV</div>
          </div>
             <div id="left-content">
               	<?php foreach($pilar as $k => $v):?>
               	<div id="left-content-inside">
                  <div class="arrow fl"></div>
                  <div class="isi fr"><span style="color:#0166a1; font-weight:bold"><?php echo strtoupper($v['name']);?></span><br>
                  <b> <?php echo $v['title'];?></b><br>
                  <?php 
				  $string=ucfirst(strtolower($v['shortdesc']));
				  $h=explode(" ",$string);
				  $hasil=implode(" ", array_splice($h, 0, 20));
				  echo $hasil;
				  ?>
					  <?php if ($v['name']=='Kesehatan') {?>
						  <a href="<?php echo base_url();?>index.php/agenda/index_kesehatan">...Selengkapnya</a></div><div class=cb></div>
                       <?php }else if($v['name']=='Pendidikan') {?>
						 <a href="<?php echo base_url();?>index.php/agenda/index_pendidikan">...Selengkapnya</a></div><div class=cb></div>
                       <?php } else if ($v['name']=='Bencana') { ?>
						  <a href="<?php echo base_url();?>index.php/agenda/index_bencana">...Selengkapnya</a></div><div class=cb></div>
                          <?php }else{ ?>
						  <a href="<?php echo base_url();?>index.php/agenda/index_lingkungan">...Selengkapnya</a></div><div class=cb></div>
                    		<?php } ?>
                    <div class="horizontal">
                    </div>
                  <div class="cb"></div>
                </div>
  				<?php endforeach; ?>
             
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
                <a href="<?php echo base_url('index.php/galeri/view_video/'.$v['id'].'/'.$slug); ?>"><div id="play-btn-small"></div>
                <?php if(empty($v['loc_pic'])){?>
                   <img src="<?php echo site_url();?>images/pundi-amal.jpg" width="218" height="124">
                <?php }else{?>
                <img src="http://static.pundiamalsctv.com<?php echo $v['loc_tpic']; ?>" width="218" height="124">
                <?php } ?>
                </a>
                <a href="<?php echo base_url('index.php/galeri/view_video/'.$v['id'].'/'.$slug); ?>">
              <?php echo ucfirst(strtolower($v['title']));
			   //echo 'xxxxx'.$v['loc_tpic'];
			  ?> </a></div>
               <div class="horizontal1"></div>
               <?php endforeach; ?>
                             
                
                
                
               <div class="cb"></div>
               </div>
            <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/galeri/galery_video">Selengkapnya</a></div>
           
            
        </div>
        
        
        
        
    </div>
    
    <div class="content-area fl">
    	<div class="content-area-inside">
       	  <div class="center">
          	<div id="slidebox">
        <!--<div class="next"></div>
        <div class="previous"></div>-->
        <div class="thumbs">
        <a href="javascript:;" onClick="Slidebox('1');return true" class="thumb">1</a>
        <a href="javascript:;" onClick="Slidebox('2');return true" class="thumb">2</a>
        <a href="javascript:;" onClick="Slidebox('3');return true" class="thumb">3</a>
        <a href="javascript:;" onClick="Slidebox('4');return true" class="thumb">4</a>
        <a href="javascript:;" onClick="Slidebox('5');return true" class="thumb">5</a>
        </div>
            <div class="container">
               <?php foreach($headline as $k => $v):?>
                <div class="content">
                  <div>
                  <div class="hl-shortd">
                   <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				  ?>
                   <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>t" title="">
                   
       
        <div class="shortdesc" title="<?php echo ucwords($v['shortdesc']); ?>"><?php echo ucwords($v['title']); ?></div>
                  </div>
                  </a>
                   <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				  ?>
                  <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><img src="http://static.pundiamalsctv.com/<?php echo($v['location']); ?>" width="440" height="283" border="0"></a></div>
                </div>
                <?php endforeach; ?>
 
            </div>
        </div>
          </div>
            
            
          <div class="titleterbaru"><img src="<?php echo base_url();?>images/terbaru_icon.png" width="18" height="18"> TERBARU</div>
            <div class="isicenter">
            	<ul>
                   <?php foreach($terbaru as $k => $v) :?>
                <li><span style="color:#777777">
				<?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span>
                  <br>
                  <span style="color:#0166a1; font-weight:bold"><?php echo $v['name'];?></span>
                  <br>
                   <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				  ?>
                  <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>
                  </a></li>
                  <?php endforeach;?>
                </ul>  
                
                <div class="cb"></div>
               
               
          </div> <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/agenda/index_terbaru">Selengkapnya</a></div><br>
           <div class="calendar">
           
          <div id="calendar"></div>
           </div>
         
         <div class="titleterbaru"><img src="<?php echo base_url();?>images/sebelumnya_icon.png" width="21" height="21"> SEBELUMNYA</div>
         <div class="isicenter">
            	<ul>
                <?php foreach($sebelumnya as $k => $v) :?>
                <li><?php if(!empty($v['location'])) {?><img src="http://static.pundiamalsctv.com/<?php echo($v['location']); ?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;
				?></span>
                  <br>
                  <span style="color:#0166a1; font-weight:bold"><?php echo $v['name'];?></span>
                  <br>
                   <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				  ?>
                  <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>" class="isicenter">
				  <?php echo ucfirst(strtolower($v['title']));?></a>		</li>
                  <?php endforeach;?>

                </ul>
                
                
                <div class="cb"></div>
               
          </div>
            <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/agenda/index_terbaru">Selengkapnya</a></div><br>
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
        <td width="80" bgcolor="#e9e9e9" align="right"><?php echo number_format($v['jumlah'],2,",",".") ;?></td>
      </tr>
      <?php endforeach;?>
      
    </table></td>
  </tr>
</table>


    
        </div>
        <div class="selengkapnya"><a href="<?php echo base_url('index.php/penyumbang/index');?>">Selengkapnya</a></div><br><br>
        
        <div><span style="font-weight:bold">NOMOR REKENING PUNDI AMAL SCTV</span>
BCA : 084 266 2000 <br /> KCU WISMA ASIA, SLIPI </div><br>
        
        <div id="title-yellow">
             	<div class="judul"><a href="<?php echo base_url();?>index.php/testimoni/index">TESTIMONI</a></div>
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
     
       <div class="selengkapnya" style="padding-right:10px;"><a href="<?php echo base_url();?>index.php/testimoni/index">Selengkapnya</a></div><br><br>
      <div id="title-yellow">
             	<div class="judul"><a href="<?php echo base_url();?>index.php/galeri/galery_foto">FOTO</a></div>
          </div>
            <?php foreach($foto as $k=>$v):?>
        <div id="left-content-inside1">
        <a href="<?php echo base_url('index.php/galeri/view_foto/'.$v['id']).'/'.$slug;?>">
        <img src="http://static.pundiamalsctv.com/<?php echo($v['location']); ?>" width="218" height="124"></a>
                 <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				  ?>
                <a href="<?php //echo base_url('index.php/show/view/'.$v['id']); 
				echo base_url('index.php/galeri/view_foto/'.$v['id']).'/'.$slug;?>"><?php echo ucfirst(strtolower($v['title']));?> </a></div>
               <div class="horizontal1"></div>
               <?php endforeach; ?>
               
      
      </div>
       <div class="selengkapnya" style="padding-right:25px;"><a href="<?php echo base_url();?>index.php/galeri/galery_foto">Selengkapnya</a></div>
        
        
        
    </div>
        
        
    </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

