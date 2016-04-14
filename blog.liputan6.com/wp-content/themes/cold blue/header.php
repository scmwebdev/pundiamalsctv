<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
</head>

<body>

<div id="header">

<div id="navbar">

<div class="menu">

<ul>
<?php wp_list_pages('title_li=0&depth=1&sort_order=desc'); ?>
<li<?php if(is_home()) {; ?> class="current_page_item"<?php } ?>><a href="<?php bloginfo('home'); ?>/">Home</a></li>
</ul>

</div>

</div>

<h1><a class="mainlink" href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>

<div id="description"><?php bloginfo('description'); ?></div>

</div>

<div id="wrapper">