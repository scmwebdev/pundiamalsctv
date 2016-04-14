<div id="mainnav">

<div id="search">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

</div>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<div class="nav">

<h2>Pages</h2>

<ul class="nav">
<?php wp_list_pages('title_li=0'); ?>
</ul>

</div>

<div class="nav">

<h2>Blogroll</h2>

<ul class="nav">

<?php wp_list_bookmarks('categorize=0&title_li=0'); ?>

</ul>

</div>

<div class="nav">

<h2><?php _e('Recently'); ?></h2>

<ul class="nav">

<?php wp_get_archives('type=postbypost&limit=5'); ?>

</ul>

</div>

<div class="nav">

<h2>Meta</h2>

<ul class="nav">
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
<li><a href="<?php bloginfo('rss2_url'); ?>">Entries RSS</a></li>
<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments RSS</a></li>
<?php wp_meta(); ?>
</ul>

</div>
	
	<?php endif; ?>

</div>