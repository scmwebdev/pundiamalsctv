<?php
if (!class_exists('OmniNogginPosts') && is_admin()) {
  class OmniNogginPosts {

    // Class initialization
    function OmniNogginPosts() {
      if (isset($_GET['show_omninoggin_widget'])) {
        if ($_GET['show_omninoggin_widget'] == "true") {
          update_option( 'show_omninoggin_widget', 'noshow' );
        } else {
          update_option( 'show_omninoggin_widget', 'show' );
        }
      }

      // Add the widget to the dashboard
      add_action( 'wp_dashboard_setup', array(&$this, 'register_widget') );
      add_filter( 'wp_dashboard_widgets', array(&$this, 'add_widget') );
    }

    // Register this widget -- we use a hook/function to make the widget a dashboard-only widget
    function register_widget() {
      wp_register_sidebar_widget( 'omninoggin_posts', __( 'OMNINOGGIN - WordPress Development', 'omninoggin-posts' ), array(&$this, 'widget'), array( 'all_link' => 'http://omninoggin.com/', 'feed_link' => 'http://omninoggin.com/feed/', 'edit_link' => 'options.php' ) );
    }

    // Modifies the array of dashboard widgets and adds this plugin's
    function add_widget( $widgets ) {
      global $wp_registered_widgets;
      if ( !isset($wp_registered_widgets['omninoggin_posts']) ) return $widgets;
      array_splice( $widgets, 2, 0, 'omninoggin_posts' );
      return $widgets;
    }

    function widget($args = array()) {
      $show = get_option('show_omninoggin_widget');
      if ($show != 'noshow') {
        if (is_array($args))
          extract( $args, EXTR_SKIP );
        echo $before_widget.$before_title.$widget_name.$after_title;
        include_once(ABSPATH . WPINC . '/rss.php');
        $rss = fetch_rss('http://feeds.feedburner.com/omninoggin');
        if (is_null($rss->items)) {
          echo "No items";
        }
        else {
          $items = array_slice($rss->items, 0, 3);
          if (empty($items)) {
            echo "No items";
          }
          else {
            foreach ( $items as $item ) : ?>
              <a style="font-size: 14px; font-weight:bold;" href='<?php echo $item['link']; ?>' title='<?php echo $item['title']; ?>'><?php echo $item['title']; ?></a><br/>
              <p style="font-size: 10px; color: #aaa;"><?php echo date('j F Y',strtotime($item['pubdate'])); ?></p>
              <p><?php echo substr($item['summary'],0,strpos($item['summary'], "This is a post from")); ?></p>
            <?php endforeach;
          }
        }
        echo $after_widget;
      }
    }
  }

  // Start this plugin once all other plugins are fully loaded
  add_action( 'plugins_loaded', create_function( '', 'global $OmniNogginPosts; $OmniNogginPosts = new OmniNogginPosts();' ) );
}
?>
