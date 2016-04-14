</div>
			</div>
			<div class="right topright">
				<div class="left center">
					<div class="content">
						<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/rss.jpg" alt="rss" /></a>
					
</br>
<script type="text/javascript"><!--
google_ad_client = "pub-7543576628758784";
google_ad_width = 120;
google_ad_height = 600;
google_ad_format = "120x600_as";
google_ad_type = "text_image";
google_ad_channel = "";
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "0A55AB";
google_color_text = "000000";
google_color_url = "0000CC";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


</div>
				</div>
				<div class="right iright">
					<div class="content">
						<ul class="sidelist">Categories
							<?php wp_list_categories('title_li='); ?>
						</ul><div class="clear"></div>
						<ul class="sidelist">Pages
							<?php wp_list_pages('title_li='); ?>
						</ul><div class="clear"></div>
						<ul class="sidelist">Archives
							<?php wp_get_archives('type=monthly'); ?>
						</ul><div class="clear"></div>

<ul class="sidelist">Blogroll
							<?php get_links(-1, '<li>', '</li>', 'between', FALSE, 'name', FALSE, FALSE, -1, FALSE); ?>
						</ul><div class="clear"></div>


						<ul class="sidelist">Meta
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
							<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
							<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
							<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
							<li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>"><abbr title="WordPress">WP</abbr></a></li>
							<?php wp_meta(); ?>
							
						</ul>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>