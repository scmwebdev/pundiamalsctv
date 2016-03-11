
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
        <div id="title-insidepage">
             	<div class="judul">Indeks Berita</div>
          </div>
    	    <div id="insidepage-content">
               	<div id="insidepage-inside">
               	    <ul>
                    <?php foreach($detail_berita as $k=>$v):?>
                <li><?php if(!empty($v['location'])) {?><img src="http://static.pundiamalsctv.com<?php echo($v['location']);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <span style="color:#3300FF">
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?> </a>.
        <span style="color:#3300FF">
         </li>
        		<?php endforeach;?>
               </ul>
                 
                 
                 <ul id="paging" class="fr">
            <?php echo $this->pagination->create_links();?></ul>
        
                 
				 <div class="cb"></div>
           
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
  <div class="selengkapnya" style="padding-right:10px;"><a href="<?php echo base_url();?>index.php/penyumbang/index">Selengkapnya</a></div><br><br>

    
        </div>
        
       
        
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
        <a href="<?php echo base_url('index.php/testimoni/view/'.$v['id_berita'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?> </a></li>
         <?php endforeach;?>
      </ul>
       </div>
     <div class="selengkapnya" style="padding-right:10px;"><a href="<?php echo base_url();?>index.php/testimoni/index">Selengkapnya</a></div><br><br>
       
     
      
      <div id="title-yellow">
             	<div class="judul">FOTO</div>
          </div>
          <div id="left-content">
           	   <?php foreach($foto as $k=>$v):?>
        <div id="left-content-inside1"><img src="http://static.pundiamalsctv.com/<?php echo($v['location']); ?>" width="218" height="124"></a>
              <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
               <a href="<?php echo base_url('index.php/galeri/view_foto/'.$v['id'].'/'.$slug); ?>"> <?php echo ucfirst(strtolower($v['title']));?></a> </div>
               <div class="horizontal1"></div>
               <?php endforeach; ?>
               <div class="selengkapnya" style="padding-right:10px;"><a href="<?php echo base_url();?>index.php/galeri/galery_foto">Selengkapnya</a></div>
      <div class="cb"></div>
      </div>
      <br>
      <div id="title-yellow">
             	<div class="judul">VIDEO</div>
             </div>
             <div id="left-content">
                <?php foreach($video as $k=>$v):?>
               	<div id="left-content-inside1">
                <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
            <a href="<?php echo base_url('index.php/galeri/view_video/'.$v['id'].'/'.$slug); ?>"><div id="play-btn-small"></div>
			<?php if(empty($v['loc_tpic'])){?>
             <img src="<?php echo site_url();?>images/pundi-amal.jpg"  width="218" height="124">
             <?php }else{?>
             <img src="http://static.pundiamalsctv.com/<?php echo $v['loc_tpic']; ?>"  width="218" height="124">
             <?php } ?>
              <?php echo ucfirst(strtolower($v['title']));?> </a>
              </div>
               <div class="horizontal1"></div>
               <?php endforeach; ?>
                <div class="selengkapnya" style="padding-right:10px;"><a href="<?php echo base_url();?>index.php/galeri/galery_video">Selengkapnya</a></div>
                
                
                
               <div class="cb"></div>
          </div>
        
        
        
        
    </div>
    
    
    
        </div>
        <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

