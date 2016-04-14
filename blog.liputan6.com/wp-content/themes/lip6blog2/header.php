<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

<meta name="verify-v1" content="fOQMqwwo+72yk0hn9FipFIQ5iNAv67msBkQ4xbAzEmw=" />
<meta name="google-site-verification" content="xmGBPdpxJcUZtru0ZWwx_ZZGgZeU0DHb6Gsfnzb1dI8" />

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<? /*<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>*/?>
<title><?php bloginfo('name'); ?><?php wp_title();?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<meta name="description" content="<?php bloginfo('description') ?>" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slider.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/glide.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/banner.css" media="screen" />

<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
    if (!document.getElementsByTagName) return false;
    var sfEls = document.getElementById("menu").getElementsByTagName("li");
    var sfEls1 = document.getElementById("catmenu").getElementsByTagName("li");
    for (var i=0; i<sfEls.length; i++) {
        sfEls[i].onmouseover=function() {
            this.className+=" sfhover";
        }
        sfEls[i].onmouseout=function() {
            this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
        }
    }
    for (var i=0; i<sfEls1.length; i++) {
        sfEls1[i].onmouseover=function() {
            this.className+=" sfhover1";
        }
        sfEls1[i].onmouseout=function() {
            this.className=this.className.replace(new RegExp(" sfhover1\\b"), "");
        }
    }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); ?>

<? /* -------- blog.liputan6.com google analytics -------- */ ?>
    <script type='text/javascript' src='http://ads.liputan6.com/www/delivery/spcjs.php?id=1'></script>
    <script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        try {
        var pageTracker = _gat._getTracker("UA-9869354-1");
            pageTracker._setDomainName(".liputan6.com");
            pageTracker._trackPageview();
        } catch(err) {}
    </script>
<? /* -------- blog.liputan6.com google analytics -------- */ ?>

</head>

<body>

<div id="wrapper">

<div id="topbar">
    <div id="dates"><?php echo date('l, F j, Y'); ?></div>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>

</div>

<div id="top">

<div class="blogname">
    <h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></h1>
    <h2><?php bloginfo('description'); ?></h2>
</div>

</div>

<div id="foxmenucontainer">
    <div id="menu">
        <ul>
            <li><a href="<?php echo get_settings('home'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/homeicon.gif"></a></li>
            <?php wp_list_categories('sort_column=name&title_li=&depth=4&number=10');
            /* wp_list_pages('title_li=&depth=4&sort_column=menu_order&include=23,26,29,30,83,196')
            wp_list_pages('title_li=&depth=4&sort_column=menu_order&exclude=52,90,141,142,143'); */?>

        </ul>
    </div>
</div>
<div class="clear"></div>
<div id="catmenucontainer">
    <div id="catmenu">
            <ul>
                <?php wp_list_categories('sort_column=name&title_li=&depth=4&exclude=13,10,4,15,8,5,41,20,37,44'); ?>
            </ul>
    </div>
</div>
<div class="clear"></div>
<div id="casing">
