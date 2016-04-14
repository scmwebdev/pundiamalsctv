<a href="<?php bloginfo('rss2_url'); ?>" id="rss">Entries (RSS)</a>
</div>

<div id="footer" class="clearfix">
<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way, it's our only promotion or advertising. -->
	<div id="about">
		<p><a href="http://wp-design.org" title="Wordpress themes design">WP-design</a> is a small web design agency located in Bucharest, Romania. We are a talented and dedicated team, mad about web design and web development. We are focused on WordPress themes.</p>	
		<div class="copy">Powered by <a href="http://wordpress.org">WordPress</a> &bull; Theme by <a href="http://wp-design.org" title="Wordpress themes design">WP-design</a></div>
	</div>
	
	<div id="meta">
		<h2>Meta</h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
			<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
			<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
			<?php wp_meta(); ?>
		</ul>
	</div>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
</body>
</html>
