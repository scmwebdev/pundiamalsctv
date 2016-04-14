<div class="clear"></div>

<div id="twit">
<div class="follow">
<a href="http://twitter.com/<?php $twit = get_option('yes_twit'); echo ($twit); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/follow.png" alt="bookmark"  /></a> 
</div>
<div id="twitter_div">
<ul id="twitter_update_list"></ul>
</div>

<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>	
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php $twit = get_option('yes_twit'); echo ($twit); ?>.json?callback=twitterCallback2&amp;count=1"></script>
</div>
 
<div id="bottom">


<div class="barone">
				<h2 class="pp">Terpopuler</h2>
		<ul>
	
			          
  
		<?php if(function_exists('akpc_most_popular')) { akpc_most_popular(); } ?>

  
	
		</ul>
		
		</div>
 
 <div class="barone">
				<h2 class="mc">Terbanyak Dikomentari</h2>

	           <ul>
  
		 <?php if(function_exists('mdv_most_commented')) { mdv_most_commented(); } ?>

         </ul>
	

		
		</div>

 
 <div class="barone">
				<h2 class="rp">Terkini</h2>
		<ul>
	
			<?php
$myposts = get_posts('numberposts=10&offset=1');
foreach($myposts as $post) :
?>
<li><a href="<?php the_permalink(); ?>"><?php the_title();
?></a></li>
<?php endforeach; ?>
	
		</ul>
		
		</div>




</div>
