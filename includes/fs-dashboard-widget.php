<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

//Parse RSS feed

function fs_parse_feed($feed_url, $limit = 5) {
    // fetch feed
    $feed = fetch_feed($feed_url);

    if (is_wp_error($feed)) {
        return;
    }

    $max_items = $feed->get_item_quantity($limit);
    $items = $feed->get_items(0, $max_items);

    if (empty($items) || !is_array($items)) {
        return;
    }
    echo '<ul>';
        foreach ($items as $item) {
        ?>
	<li>
            <a href="<?php echo esc_url($item->get_permalink()); ?>">
                <?php echo esc_html($item->get_title()); ?>
            </a>
			<span style="float:right"><?php echo $item->get_date('F d'); ?></span>
        </li>
        <?php
        }
    echo '</ul>';
}

//Begin FreshySites Dashboard Widget Custimzations

add_action('wp_dashboard_setup', 'fs_custom_dashboard_widgets');

function fs_custom_dashboard_widgets() {
global $wp_meta_boxes;

// Begin Unset Dashboard Widgets
	$fs_support_widget = $wp_meta_boxes['dashboard']['normal']['core']['fs_support_widget'];
	unset(
          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'],
          $wp_meta_boxes['dashboard']['normal']['core']['pressable_dashboard_widget']
     );

// End Unset Dashboard Widgets

// Begin FreshySites Dashboard Widget

wp_add_dashboard_widget('fs_support_widget', 'FreshySites Support' , 'fs_dashboard_support' , 'dashboard', 'side', 'high' );
}

function fs_dashboard_support() {
	echo '<br>';
	echo '<img src="' . esc_url( plugins_url( '/assets/FS_Horizontal_RGB.svg', __FILE__ ) ) . '" > ';
	echo '<p></p>';
	echo '<center>';
	echo ' <button type="button" class="fs-help-button"><a href="https://freshysites.com/team/" target="_blank" style="color:white!important">Our Team</a></button> ' ;
	echo ' <button type="button" class="fs-help-button"><a href="https://kb.freshysites.com/collection/95-how-to-guides" target="_blank" style="color:white!important">How-To Guides</a></button> ';
	?><button type="button" class="fs-help-button" onclick="return Beacon('toggle')" style="cursor:pointer;"><a style="color:white!important">Contact Support</a></button><?php
	echo '</center>';
	echo '<p></p>';
	echo '<br>';
	echo '<h3 style="font-weight:700;">Latest from FreshySites</h3>';
	echo '<hr>';
	echo '<div class="rss-widget">';
  	/*  wp_widget_rss_output(array(
          'url' => 'https://freshysites.com/feed/',
          'title' => 'Whats up at FreshySites',
          'items' => 4,
          'show_summary' => 0,
          'show_author' => 0,
          'show_date' => 1
     )); */
	 echo fs_parse_feed('https://freshysites.com/feed/');
     echo "</div>";
}

//End FreshySites Dashboard Widget
?>
