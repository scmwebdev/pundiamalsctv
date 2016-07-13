
    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
    	    <div id="insidepage-content">
               	<div id="insidepage-inside">
                 <span style="font-weight:bold; font-size:16px"> <?php echo $ambilisi[0]['title'];?></span>
                 <p><?php if(!empty($ambilisi[0]['location'])) {?><img src="<?php echo base_url().'images/'.substr($ambilisi[0]['location'],1);?>" width="700" height="300"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="700" height="300"><?php } ?><br>
                    <?php echo $ambilisi[0]['news']; ?>
                     
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

