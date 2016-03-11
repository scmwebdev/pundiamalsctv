
    
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
					'image'         : 'http://static.pundiamalsctv.com/<?php echo $ambilvideo[0]['loc_pic'];?>',
					'file'  : 'http://static.pundiamalsctv.com<?php echo $ambilvideo[0]['loc_vic'];?>',
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
          
         <div class="list_carousel">
				<ul id="foo3">
                <?php foreach($video_lainnya as $k=>$v):?>
				  <li style="width: 210px; height: 133px;"><a href="<?php echo base_url('index.php/galeri/view_video/'.$v['id']); ?>" alt="<?php echo $v["title"];?>"><div id="play-btn-video"></div>
                   <?php if(empty($v['loc_tpic'])){?>
                   <img src="<?php echo site_url();?>images/pundi-amal.jpg" width="210px" height="133px">
                <?php }else{?>
                <img src="http://static.pundiamalsctv.com/<?php echo $v['loc_pic']; ?>" width="210px" height="133px">
                <?php } ?></a>
                </li>
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
      <?php foreach($left_terbaru as $k=>$v):?>
       <li><span style="color:#777777"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
				echo $tanggal;?></span>
          <br>
      <span style="color:#0478b5; font-weight:bold"><?php echo $v['name'];?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>   
        <?php endforeach;?>
      </ul>
      
       
      </div>
      <span class="selengkapnya" style="float:right; padding-right:10px"><a href="<?php echo base_url();?>index.php/agenda/index_berita">Selengkapnya</a></span><br><br>
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
        <a href="<?php echo base_url('index.php/agenda/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>
      <?php endforeach;?>
      </ul>
      
       
      </div>
     <span class="selengkapnya" style="float:right; padding-right:10px"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Selengkapnya</a></span><br><br> 
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

