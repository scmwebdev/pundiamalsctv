
    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
    	    <div id="insidepage-content">
               	<div id="insidepage-inside">
                 <span style="font-weight:bold; font-size:16px"><?php echo $ambilfoto[0]['title'];?></span>
                 <p><?php if(!empty($ambilfoto[0]['location'])) {?><img src="<?php echo base_url(). 'images/'. substr($ambilfoto[0]['location'],1);?>" width="700" height="300" class="rheda"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="700" height="300"  class="rheda"><?php } ?><br>
                    <?php echo $ambilfoto[0]['description'];?>  
                 
                  </div>
          
         <div class="list_carousel">
         
				<ul id="foo3">
				  <?php foreach($foto_lainnya as $k=>$v):?>
				  <li style="width: 210px; height: 133px;"><?php if(!empty($v['location'])) {?><a href="#" alt="<?php echo $v["title"];?>" onClick="showPreview('<?php echo base_url() . 'images/' . substr($v['location'],1);?>'); return false"><img src="<?php echo base_url() . 'images/' . substr($v['location'],1);?>" width="210px" height="133px"></a><?php }else{?><a href="#" onClick="showPreview('<?php echo site_url();?>images/pundi-amal.jpg'); return false"><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="210px" height="133px"><?php } ?></a></li>
                 <?php endforeach;?>
				</ul>
			<div class="clearfix"></div>
              
				<a id="prev3" class="prev" href="#"><img src="<?php echo base_url();?>images/arrow_left.png" style="padding-top:5px" /></a>
				<a id="next3" class="next" href="#"><img src="<?php echo base_url();?>images/arrow_right.png" style="padding-top:5px" /></a>
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
				echo $tanggal;?></span>
          <br>
      <span style="color:#0478b5; font-weight:bold"><?php echo $v['name'];?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo $v['title'];?>. </a></li>  
       <?php endforeach; ?> 
      </ul>
      
       
      </div>
      <span class="selengkapnya" style="float:right; padding-right:10px"><a href="<?php echo base_url('index.php/agenda/index_terbaru'); ?>">Selengkapnya</a></span><br><br>
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
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo $v['title'];?></a></li>
      <?php endforeach;?>
    
       
      </div>
      <span class="selengkapnya" style="float:right; padding-right:10px"><a href="<?php echo base_url('index.php/agenda/info_kegiatan/'); ?>">Selengkapnya</a></span><br><br>
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

