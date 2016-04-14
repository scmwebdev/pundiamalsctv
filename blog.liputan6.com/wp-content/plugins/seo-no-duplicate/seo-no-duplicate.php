<?php
/*
Plugin Name: SEO No Duplicate
Plugin URI: http://omninoggin.com/wordpress-plugins/seo-no-duplicate-wordpress-plugin/
Description: This plugin helps you manage your search engine duplicate content, by setting your post page's canonical to the permalink.
Version: 0.3.2
Author: Thaya Kareeson
Author URI: http://omninoggin.com
*/

/*
Copyright 2009 Thaya Kareeson (email : thaya.kareeson@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

function snd_admin_notify($message, $error=false) {
  if ( !$error ) {
    echo '<div class="updated fade"><p>'.$message.'</p></div>';
  }
  else {
    echo '<div class="error"><p>'.$message.'</p></div>';
  }
}

function snd_admin_notify_version() {
  global $wp_version;
  snd_admin_notify('You are using WordPress version '.$wp_version.'.  SEO No Duplicate recommends that you use WordPress 2.7 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>');
}

function snd_admin_check_version() {
  global $wp_version;
  if (!empty($wp_version) && is_admin() && version_compare($wp_version,"2.7","<"))
    add_action('admin_notices', 'snd_admin_notify_version');
}

function snd_set_canonical() {
  global $wp_query;

  // Shamelessly ripped [and slightly modified] from Joost De Valk's Canonical plugin, http://yoast.com/wordpress/canonical/
  if ($wp_query->is_404 || $wp_query->is_search) {
    return false;
  }

  $haspost = count($wp_query->posts) > 0;
  $has_ut = function_exists('user_trailingslashit');

  if (get_query_var('m')) {
    // Handling special case with '?m=yyyymmddHHMMSS'
    // Since there is no code for producing the archive links for
    // is_time, we will give up and not try to produce a link.
    $m = preg_replace('/[^0-9]/', '', get_query_var('m'));
    switch (strlen($m)) {
      case 4: // Yearly
        $link = get_year_link($m);
        break;
      case 6: // Monthly
        $link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
        break;
      case 8: // Daily
        $link = get_day_link(substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
        break;
      default:
        return false;
    }
  } elseif (($wp_query->is_single || $wp_query->is_page) && $haspost) {
    $post = $wp_query->posts[0];
    $canonical_override = get_post_meta($post->ID, 'canonical', true);
    if ( !empty($canonical_override) ) {
      $link = $canonical_override;
    }
    else {
      $link = get_permalink($post->ID);
      $page = get_query_var('paged');
      if ($page && $page > 1) {
        $link = trailingslashit($link) . "page/". "$page";
        if ($has_ut) {
          $link = user_trailingslashit($link, 'paged');
        } else {
          $link .= '/';
        }
      }
      // WP2.2: In Wordpress 2.2+ is_home() returns false and is_page() 
      // returns true if front page is a static page.
      if ($wp_query->is_page && ('page' == get_option('show_on_front')) && 
        $post->ID == get_option('page_on_front'))
      {
        $link = trailingslashit($link);
      }
    }
  } elseif ($wp_query->is_author && $haspost) {
    global $wp_version;
    if ($wp_version >= '2') {
      $author = get_userdata(get_query_var('author'));
      if ($author === false)
        return false;
      $link = get_author_link(false, $author->ID,
        $author->user_nicename);
    } else {
      // XXX: get_author_link() bug in WP 1.5.1.2
      //    s/author_nicename/user_nicename/
      global $cache_userdata;
      $userid = get_query_var('author');
      $link = get_author_link(false, $userid,
        $cache_userdata[$userid]->user_nicename);
    }
  } elseif ($wp_query->is_category && $haspost) {
    $link = get_category_link(get_query_var('cat'));
  } elseif ($wp_query->is_day && $haspost) {
    $link = get_day_link(get_query_var('year'),
               get_query_var('monthnum'),
               get_query_var('day'));
  } elseif ($wp_query->is_month && $haspost) {
    $link = get_month_link(get_query_var('year'),
                 get_query_var('monthnum'));
  } elseif ($wp_query->is_year && $haspost) {
    $link = get_year_link(get_query_var('year'));
  } elseif ($wp_query->is_home) {
    // WP2.1: Handling "Posts page" option. In WordPress 2.1 is_home() 
    // returns true and is_page() returns false if home page has been 
    // set to a page, and we are getting the permalink of that page 
    // here.
    if ((get_option('show_on_front') == 'page') &&
      ($pageid = get_option('page_for_posts'))) 
    {
      $link = trailingslashit(get_permalink($pageid));
    } else {
      $link = trailingslashit(get_option('home'));
    }
  } else {
    return;
  }

  echo '<link rel="canonical" href="'.$link.'"/>';
}
add_action('admin_head', 'snd_admin_check_version');
add_action('wp_head', 'snd_set_canonical');
?>
