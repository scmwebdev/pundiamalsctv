<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
  "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">



<head>
<title><?php bloginfo('name'); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">


<meta name="generator" content="WordPress <?php bloginfo('version'); ?>">



<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen">

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">



<?php wp_head(); ?>

</head>

<body>
		<div id="header">
		<div class="container">
			<ul id="nav"><?php wp_list_pages('title_li='); ?></ul>
			<div id="ltr">
				<div id="picture"></div>
				<div id="sub"><?php bloginfo('description'); ?></div>
				<div class="clear"></div>
				<div id="rss1"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/rss1.jpg" alt="rss1" /></a></div>
			</div>
		</div>
	</div>
	<div class="container white">
			<div class="left topleft">
				<div class="content">