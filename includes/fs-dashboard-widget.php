<?php

if ( ! defined( 'ABSPATH' ) ) {
	die();
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

wp_add_dashboard_widget('fs_support_widget', 'FreshySites Support', 'fs_dashboard_support' , 'dashboard', 'side', 'high' );
}

function fs_dashboard_support() {
	echo '<br>';
	echo '<img src="' . esc_url( plugins_url( '/assets/fs-formal-horizontal.svg', __FILE__ ) ) . '" > ';
	echo '<p><center><iframe width="100%" height="218" src="https://www.youtube.com/embed/eU9FruuFxk4?loop=1&modestbranding=1&rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen"></iframe></center></p>';
	echo '<p></p>';
	echo '<center>';
	echo ' <button type="button" class="fs-help-button"><a href="https://freshysites.com/team/" target="_blank" style="color:white!important">Our Team</a></button> ' ;
	echo ' <button type="button" class="fs-help-button"><a href="https://kb.freshysites.com/collection/95-how-to-guides" target="_blank" style="color:white!important">How-To Guides</a></button> ';
	echo ' <button type="button" class="fs-help-button"><a href="https://freshysites.com/support/" target="_blank" style="color:white!important">Contact Support</a></button> ';
	echo '</center>';
	echo '<br>';
	echo '<hr>';
	echo '<h3 style="font-weight:700;">FAQs</h3>';
	echo '<a href="https://kb.freshysites.com/category/113-basic-wordpress" target="_blank">How can I learn more about WordPress basics and editing?</a>';
	echo '<hr>';
	echo '<h3 style="font-weight:700;">Latest from FreshySites</h3>';
	echo '<hr>';
	echo '<div class="rss-widget">';
     wp_widget_rss_output(array(
          'url' => 'https://freshysites.com/feed/',
          'title' => 'Whats up at FreshySites',
          'items' => 4,
          'show_summary' => 0,
          'show_author' => 0,
          'show_date' => 1
     ));
     echo "</div>";
}

//End FreshySites Dashboard Widget
?>
