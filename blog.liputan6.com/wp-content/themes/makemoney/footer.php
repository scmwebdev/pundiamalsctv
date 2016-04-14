<div id="footer">
				<div class="fl left"><h2>RECENT ENTRIES</h2><ul><?php
 global $post;
 $myposts = get_posts('numberposts=5&offset=0');
 foreach($myposts as $post) :
 setup_postdata($post);
 ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
 <?php endforeach; ?></ul></div>
				<div class="ft right">
					<div class="fc left"><h2>LINKS</h2><ul><li><a href="#">Link1</a></li><li><a href="#">Link2</a></li><li><a href="#">Link3</a></li><li><a href="#">Link4</a></li></ul></div>
					<div class="fr right"><h2>ABOUT US</h2>Make Money Online is a premium Wordpress Theme designed for Make Money Blogs. 
					<br /><br />Lorem Ipsum dolor sit Amet veritas liberabit vos .</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div><br />
				<b>Make Money Blog. 2007. Design by <a href="http://neilduckett.com/" alt="Neil">Neil Duckett</a>.</b>
			</div>
		</div>
</body>
</html>