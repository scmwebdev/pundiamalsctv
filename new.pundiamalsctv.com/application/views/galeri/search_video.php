
    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
        	
             <div id="title-insidepage">
             	<div class="judul">Pundi Amal SCTV : Kumpulan Artikel >>></div>
          </div>
             <div id="insidepage-content">
               	<div id="insidepage-inside">
                <?php
					if (empty($search)) {
						echo "<center> Data tidak ditemukan </center>";
					}
					else {
				?>
                  <ul>                  
                  <?php foreach($search as $v => $k): ?>
                   <li><?php if(!empty($k['location'])) {?><img src="http://static.pundiamalsctv.com<?php echo($k['location']);?>" width="144" height="81" class="fl mr6"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="144" height="81" class="fl mr6"><?php } ?><span style="color:#77777"><?php $tanggal=date("d-m-Y", strtotime($k['dates']));
				echo $tanggal;?></span><br>
                <?php
				  $slug = url_title($k['title'], 'dash', true);
				  //print_r($slug);
				?>
                <b> <a href="<?php echo base_url('index.php/galeri/view_video/'.$k['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($k['title']));?></a></b>
                    <br>
                    <?php echo ucfirst(strtolower($k['shortdesc']));?>
                    </li>
                    
                    <?php endforeach; ?>
                  </ul>
            <?php }?>
                 <ul id="paging" class="fr">
            		<?php echo $this->pagination->create_links();?>
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
<div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/penyumbang/index">Selengkapnya</a></div><br><br>

    
        </div>
         
        <div id="title-yellow">
             	<div class="judul">TERBARU</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
      <?php foreach($terbaru as $k => $v):?>
      <li><span style="color:#77777"><img src="http://static.pundiamalsctv.com<?php echo($v['location']);?>" width="144" height="81" class="fl mr6"><?php $tanggal=date("d-m-Y", strtotime($k['dates']));
				echo $tanggal;?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/galeri/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>  
       <?php endforeach; ?>
      </ul>
      <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/agenda/index_berita">Selengkapnya</a></div><br><br>
       
      </div>
      
      </div>

      
      
       <div id="title-yellow">
             	<div class="judul">INFO KEGIATAN</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
      <?php foreach($info_kegiatan as $k => $v):?>
      <li><span style="color:#7777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
	  echo $tanggal;
	  ?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/galeri/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>
      <?php endforeach;?>
      </ul>
     <div class="selengkapnya mr30"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Selengkapnya</a></div><br><br>
       
      </div>
      
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

