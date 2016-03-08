<?php
require 'facebook/facebook.php';
		$facebook = new Facebook(array(
			'appId' => '645664388788940',
			'secret' =>'35d22d28ceb4c5d97c5eefe6b9ee8b1e',
		));  
		
	// See if there is a user from a cookie
		$user = $facebook->getUser();

if ($user) {
	try {
				// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	    } catch (FacebookApiException $e) {
		echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
		$user = null;
		}
			}
				
?>
    
    <div id="content" class="fl">
    	<div id="insidepage-container" class="fl">
    	    <div id="insidepage-content">
               	<div id="insidepage-inside">
                 <span style="font-weight:bold; font-size:16px"> <?php echo $ambilisi[0]['title'];?></span>
                 <p><?php if(!empty($ambilisi[0]['location'])) {?><img src="http://static.pundiamalsctv.com<?php echo $ambilisi[0]['location'];?>" width="700" height="300"><?php }else{?><img src="<?php echo site_url();?>images/pundi-amal.jpg" width="700" height="300"><?php } ?><br>
                    <?php echo $ambilisi[0]['news']; ?>
					
					<div>
				
				<a href="#"  onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;"><img src="<?php echo base_url();?>images/Share.png" alt="share"></a>
					<script>
					!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
					</script>
					
					<div class="wdt"><a href="https://twitter.com/share" class="twitter-share-button" data-via="pundiamalsctv" data-lang="en">Tweet</a></div>
				</div>
                     
                  </div>
          
         <div class="baca-juga" style="margin-top: 0px;">
            <strong>Baca juga:</strong>
            <ul>
                  <?php foreach($baca_juga as $k => $v) :?>
                <li><span style="color:#3300FF">
                <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
                  <a href="<?php echo base_url('index.php/penyumbang/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucwords($v['title']);?>
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
        <a href="<?php echo base_url('index.php/penyumbang/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?>. </a></li>  
       <?php endforeach; ?> 
      </ul>
     
       
      </div>
       <span class="selengkapnya" style="float:right; padding-right:10px"><a href="<?php echo base_url();?>index.php/agenda/index_terbaru">Selengkapnya</a></span><br><br />
      </div>
      
      
       <div id="title-yellow">
             	<div class="judul">INFO KEGIATAN</div>
          </div>
      <div id="left-content">
      <div id="left-content-insidepage">
      <ul>
      <?php foreach($info_kegiatan as $k => $v):?>
      <li><span style="color:#0478b5"><?php $tanggal=date("d-m-Y", strtotime($v['dates']));
	  echo $tanggal;
	  ?></span>
        <br>
        <?php
				  $slug = url_title($v['title'], 'dash', true);
				  //print_r($slug);
				?>
        <a href="<?php echo base_url('index.php/penyumbang/view/'.$v['id'].'/'.$slug); ?>"><?php echo ucfirst(strtolower($v['title']));?></a></li>
      <?php endforeach;?>
      </ul>
      
       
      </div>
      <span class="selengkapnya" style="float:right; padding-right:10px"><a href="<?php echo base_url();?>index.php/agenda/info_kegiatan">Selengkapnya</a></span><br><br />
      </div>
        </div>
    <div class="cb"></div>
    </div>
    <div class="cb"></div>
</div>

