<?php
/**
* Plugin Name: FreshySites Support
* Plugin URI: https://freshysites.com/
* Description: Provides access the FS “How-To” Guides and ability to quickly contact our Support Team
* Version: 2.0.0
* Author: FreshySites
* Author URI: https://freshysites.com/
*/

//Begin Admin Only FreshySites Beacon with Chat

function freshy_admin_scripts() {

wp_register_script( 'chat-beacon-javascript', plugins_url('/js/chat-beacon.js' , __FILE__) );

wp_enqueue_script( 'chat-beacon-javascript' );

} // end custom_register_admin_scripts

add_action( 'admin_enqueue_scripts', 'freshy_admin_scripts' );

// End Admin Only Freshysites Beacon with Chat

// remove Pressable Dashboard widget
function freshy_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['pressable_dashboard_widget']);
}

add_action('wp_dashboard_setup', 'freshy_remove_dashboard_widgets' );
// End Remove Pressable Dashboard widget
//
//Begin enqueue FreshySites Custom Admin dashboard
function freshysites_enqueue_custom_admin_theme() {
    wp_enqueue_style( 'freshysites-enqueue-custom-admin-theme', plugins_url( 'wp-admin.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'freshysites_enqueue_custom_admin_theme' );


//Begin FreshySites Dashboard Widget
//
// display featured post thumbnails in WordPress feeds



add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
	unset(  
          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],  
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],  
          $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']  
     );  
 
wp_add_dashboard_widget('custom_help_widget', 'FreshySites Support', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
	echo '<br><img src="https://freshysites.com/wp-content/uploads/fs-formal-horizontal.svg">';
	echo '<p><center><iframe width="100%" height="218" src="https://www.youtube.com/embed/js_-p_d6_FQ?loop=1&modestbranding=1&rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen"></iframe></center></p>';
	echo '<p></p>';
	echo '<center>';
	echo ' <button type="button" class="button button-primary"><a href="https://freshysites.com/team/" target="_blank" style="color:white!important">Our Team</a></button> ' ;
	echo ' <button type="button" class="button button-primary"><a href="https://kb.freshysites.com" target="_blank" style="color:white!important">Knowledge Base</a></button> ';
	echo ' <button type="button" class="button button-primary"><a href="https://freshysites.com/support/" target="_blank" style="color:white!important">Contact Support</a></button> ';
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
function wcs_post_thumbnails_in_feeds( $content ) {
    global $post;
    if( has_post_thumbnail( $post->ID ) ) {
        $content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
    }
    return $content;
}
add_filter( 'the_excerpt_rss', 'wcs_post_thumbnails_in_feeds' );
add_filter( 'the_content_feed', 'wcs_post_thumbnails_in_feeds' );

function dashboard_custom_feed_output() {  
     
}  

//End FreshySites Dashboard Widget
//
//
//
//
//Experimental Features
add_action( 'admin_menu', 'fs_post_info_menu' );
function fs_post_info_menu(){    
	$page_title = 'FreshySites Support';   
	$menu_title = ' FS Support';   
	$capability = 'manage_options';   
	$menu_slug  = 'fs-post-info';   
	$function   = 'fs_support_info_page';   
	$icon_url   = 'https://griffinpsychiatry-sandbox.mystagingwebsite.com/wp-content/uploads/fs-admin-menu-icon-2.svg';   
	$position   = 0;    
	add_menu_page( 
		$page_title,                  
		$menu_title,                   
		$capability,                   
		$menu_slug,                   
		$function,                   
		$icon_url,                   
		$position ); 
} 

// All About Updates 
// 
// All About Updates 
// 
//  Begin Version Control | Auto Aupdate Checker 
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/FreshyMichael/freshy-support/',
	__FILE__,
	'freshysites-support-beacon'
);
//Enable Releases
$myUpdateChecker->getVcsApi()->enableReleaseAssets();
//Optional: If you're using a private repository, specify the access token like this:
//
//
//Future Update Note: Comment in these sections and add token and branch information once private git established
//
//
//$myUpdateChecker->setAuthentication('your-token-here');
//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('stable-branch-name');