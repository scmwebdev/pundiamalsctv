    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
        	
             <div id="title-insidepage">
             	<div class="judul">MITRA</div>
          </div>
             <div id="insidepage-content">
               	<div id="insidepage-inside">
                 
                 <p><img src="<?php echo base_url();?>images/mitra.jpg" width="700" height="300"><br>
                  <ul>
                  <?php foreach($mitra as $k=>$v):?>
                  <li><?php if(!empty($v['location'])) {?><img src="<?php echo base_url().'images/'.substr($v['location'],1);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span><br>
                <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
                   <a target="_blank" href="<?php echo base_url('index.php/mitra/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?> </a></li>
                  <?php endforeach;?>
                  
                  </ul>
              
          <ul id="paging" class="fr">
          	 <?php echo $links;?> 
          </ul>
          </div>
          
         
                 
			   <div class="cb"></div>
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


    
        </div>
      <div class="selengkapnya"><a href="<?php echo base_url('index.php/penyumbang/index');?>">Selengkapnya</a></div><br><br>  
       
              <div><span style="font-weight:bold">NOMOR REKENING PUNDI AMAL SCTV</span>
BCA : 084 266 2000 <br /> KCU WISMA ASIA, SLIPI </div><br>
        
        <div id="title-yellow">
             	<div class="judul">TERBARU</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
      <?php foreach($terbaru as $k => $v) :?>
      <li><span style="color:#777777">
		<?php $tanggal=date("d-m-Y", strtotime($v['dates']));
		echo $tanggal;?></span>
                  <br>
        <span style="color:#0478b5; font-weight:bold"><?php echo $v['name'];?></span>
                  <br>
                  <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
         <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucwords($v['title']);?>
                  </a></li>
       <?php endforeach;?>
     
      </ul>
      
       
      </div>
      <div class="selengkapnya"><a href="<?php echo base_url();?>index.php/agenda/index_terbaru">Selengkapnya</a></div><br><br>
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
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower( $v['title']));?></a></li>
      <?php endforeach;?>  
      </ul>
     
       
      </div>
       <div class="selengkapnya"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Selengkapnya</a></div><br><br>
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

