<?php
/*
Plugin Name: NextGEN Gallery
Plugin URI: http://alexrabe.boelinger.com/?page_id=80
Description: A NextGENeration Photo gallery for the WEB2.0(beta).
Author: NextGEN DEV-Team
Version: 0.80

Author URI: http://alexrabe.boelinger.com/

Copyright 2007 by Alex Rabe & NextGEN DEV-Team

The NextGEN button is taken from the Silk set of FamFamFam. See more at 
http://www.famfamfam.com/lab/icons/silk/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/ 

//#################################################################
// Stop direct call
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

//#################################################################
// Let's Go
	
global $wpdb, $wp_version, $wpmu_version, $wp_roles;

// ini_set('display_errors', '1');
// ini_set('error_reporting', E_ALL);

// Check for WPMU installation
define('IS_WPMU', version_compare($wpmu_version, '1.3', '>=') );

//This works only in WP2.2 or higher
if ((version_compare($wp_version, '2.1', '>=')) or (IS_WPMU)){

// Version and path to check version
define('NGGVERSION', "0.80");
define('NGGURL', "http://nextgen.boelinger.com/version.php");

// define URL
$myabspath = str_replace("\\","/",ABSPATH);  // required for Windows & XAMPP
define('WINABSPATH', $myabspath);
define('NGGFOLDER', dirname(plugin_basename(__FILE__)));
define('NGGALLERY_ABSPATH', $myabspath.'wp-content/plugins/' . NGGFOLDER .'/');
define('NGGALLERY_URLPATH', get_option('siteurl').'/wp-content/plugins/' . NGGFOLDER.'/');

// look for imagerotator
define('NGGALLERY_IREXIST', file_exists(NGGALLERY_ABSPATH.'imagerotator.swf'));

// get value for safe mode
if ((gettype(ini_get('safe_mode')) == 'string')) {
	// if sever did in in a other way
	if (ini_get('safe_mode') == 'off') define('SAFE_MODE', FALSE);
	else define('SAFE_MODE', ini_get('safe_mode'));
} else
define('SAFE_MODE', ini_get('safe_mode'));

//pass the init check or show a message
if (get_option( "ngg_init_check" ) != false )
	add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . get_option( "ngg_init_check" ) . '</strong></p></div>\';'));

//read the options
$ngg_options = get_option('ngg_options');

// add database pointer 
$wpdb->nggpictures					= $wpdb->prefix . 'ngg_pictures';
$wpdb->nggallery					= $wpdb->prefix . 'ngg_gallery';
$wpdb->nggalbum						= $wpdb->prefix . 'ngg_album';
$wpdb->nggtags						= $wpdb->prefix . 'ngg_tags';
$wpdb->nggpic2tags					= $wpdb->prefix . 'ngg_pic2tags';

// Load language
function nggallery_init ()
{
	load_plugin_textdomain('nggallery','wp-content/plugins/' . NGGFOLDER.'/lang');
}

// Load the admin panel
if (is_admin()) {
	include_once (dirname (__FILE__)."/ngginstall.php");
	include_once (dirname (__FILE__)."/admin/admin.php");
} else {
// Load the gallery generator
	include_once (dirname (__FILE__)."/nggfunctions.php");
}

// Load tinymce button 
include_once (dirname (__FILE__)."/tinymce/tinymce.php");

// Load gallery class
require_once (dirname (__FILE__).'/lib/nggallery.lib.php');

// Init the clas
$nggallery = new nggallery();

// Add rewrite rules
$nggRewrite = new nggRewrite();

// add javascript to header
add_action('wp_head', 'ngg_addjs', 1);
function ngg_addjs() {
    global $wp_version, $ngg_options;
    
	echo "<meta name='NextGEN' content='".NGGVERSION."' />\n";
	if ($ngg_options['activateCSS']) 
		echo "\n".'<style type="text/css" media="screen">@import "'.NGGALLERY_URLPATH.'css/'.$ngg_options['CSSfile'].'";</style>';
	if ($ngg_options['thumbEffect'] == "thickbox") {
		echo "\n".'<script type="text/javascript"> var tb_pathToImage = "'.NGGALLERY_URLPATH.'thickbox/'.$ngg_options['thickboxImage'].'";</script>';
		echo "\n".'<style type="text/css" media="screen">@import "'.NGGALLERY_URLPATH.'thickbox/thickbox.css";</style>'."\n";
	    if ($wp_version < "2.3") {
	    	if ($wp_version > "2.1.3") wp_deregister_script('jquery'); 
	    	wp_enqueue_script('jquery', NGGALLERY_URLPATH .'admin/js/jquery.js', FALSE, '1.1.3.1');
		} 
	    	wp_enqueue_script('thickbox', NGGALLERY_URLPATH .'thickbox/thickbox-pack.js', array('jquery'), '3.1.1');

    	// add NextGEN jQuery Plugin
		if ($ngg_options['galUsejQuery'])
			wp_enqueue_script('nextgen', NGGALLERY_URLPATH .'admin/js/jquery.nextgen.pack.js', array('jquery'), '0.5');
			//TODO: NEW AJAX Version
			// wp_enqueue_script('nextgen-ajax', NGGALLERY_URLPATH .'admin/js/jquery.nextgen.ajax.js', array('jquery'), '0.1');
			// wp_enqueue_script('blockui', NGGALLERY_URLPATH .'admin/js/jquery.blockUI.js', array('jquery'), '0.1');
	    }
	    
	// test for wordTube function
	if (!function_exists('integrate_swfobject')) {
		wp_enqueue_script('swfobject', NGGALLERY_URLPATH .'admin/js/swfobject.js', FALSE, '1.5');
	}
}

// load language file
add_action('init', 'nggallery_init');

// Init options & tables during activation 
// add_action('activate_' . NGGFOLDER.'/nggallery.php', 'ngg_install');
// WP recommended function, not used until 2.2.3
register_activation_hook(NGGFOLDER.'/nggallery.php','ngg_install');
register_deactivation_hook(NGGFOLDER.'/nggallery.php','ngg_deinstall');

// init tables in wp-database if plugin is activated
function ngg_install() {
	global $nggRewrite;
	// Check for admin role
	nggallery_install();
	// Flush ReWrite rules
	$nggRewrite->flush();
}

function ngg_deinstall() {
	// remove & reset the init check option
	delete_option( "ngg_init_check" );
}

// Action calls for all functions 
add_filter('the_content', 'searchnggallerytags');
add_filter('the_excerpt', 'searchnggallerytags');

// Content Filters
add_filter('ngg_gallery_name', 'sanitize_title');

} else {
	add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade"><p><strong>' . __('Sorry, NextGEN Gallery works only under WordPress 2.1 or higher',"nggallery") . '</strong></p></div>\';'));
}// End Check for WP 2.1
?>