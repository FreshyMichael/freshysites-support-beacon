<?php
/**
* Plugin Name: FreshySites Support
* Plugin URI: https://freshysites.com/
* Description: Provides access to the FS “How-To” Guides and ability to quickly contact our Support Team
* Version: 3.1.0
* Author: FreshySites
* Author URI: https://freshysites.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
//Define the Version #

//Define PLUGIN_DIR if not already defined

define('PLUGIN_DIR' , dirname(__FILE__).'/');


//Include these files always
include 'includes/fs_count_emails_wp.php';
include 'divi_object_cache_snippet.php';
include 'includes/fs_support_settings.php';

//Include these file if the current user can manage options (is admin)
function fs_adminOnly_functions(){

		//If the user cannot manage options, don't setup the support beacon, dashboard widget or the admin menu page
		if ( ! current_user_can( 'manage_options' )) {
			return;
		}
		else{
			//Include the Administrator Only function files
			include 'includes/fs-dashboard-widget.php';
			include 'includes/fs-support-beacon.php';
			include 'includes/fs-menu-pages.php';
		}

}



//Add the action
add_action ('after_setup_theme' , 'fs_adminOnly_functions');

/* Hide Blogvault from non @freshysites.com Users */

// Check if Blogvault plugin is active
if ( is_plugin_active( 'blogvault-real-time-backup/blogvault.php' ) ) {
	// hide it from the Plugin list
	add_filter('all_plugins', 'fs_remove_blogvault_admin_plugin_list');
	function fs_remove_blogvault_admin_plugin_list($plugins) {
		// get current User
		$user = wp_get_current_user(); 
		// get their email address
		$email = $user->user_email;
		// check the email's domain
		$domain = 'freshysites.com';
		// check if email address matches domain list
		$banned = strpos($email, $domain) === false;
		// if current user's email addess doesn't match domain list, then hide the menu items
		if( $user && $banned ) {
			unset($plugins['blogvault-real-time-backup/blogvault.php']);
		}
		return $plugins;
	}
	// hide it from the Admin menu
	add_action('admin_menu', 'fs_remove_blogvault_admin_menu_links', 999);
	function fs_remove_blogvault_admin_menu_links() {
		// get current User
		$user = wp_get_current_user(); 
		// get their email address
		$email = $user->user_email;
		// check the email's domain
		$domain = 'freshysites.com';
		// check if email address matches domain list
		$banned = strpos($email, $domain) === false;
		// if current user's email address doesn't match domain list, then hide the menu items
		if( $user && $banned ) {
			remove_menu_page('bvbackup');
		}
	}
}
    
//Begin enqueue FreshySites Custom Admin dashboard
function freshysites_admin_theme() {
    $dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('freshysites-admin-theme', $dir . '/fs-admin.css', array(), '3.1.0', 'all');
}
add_action( 'admin_enqueue_scripts', 'freshysites_admin_theme' );


// Hide Jetpack warnings based on Settings Selection

function fs_hide_jetpack_warning(){
		$jp_hide_warning = get_option('hide_jetpack_threat_select');
		
		if (!empty($jp_hide_warning)) {
   			foreach ($jp_hide_warning as $key => $option)
        	$options[$key] = $option;
		}
	
		if ('option1' == $jp_hide_warning[0]){
			echo '<style> li#wp-admin-bar-jetpack-scan-notice {display:none!important;} </style>';
		}
}
add_action('admin_head' , 'fs_hide_jetpack_warning' );  

//  Begin Version Control | Auto Update Checker
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/FreshyMichael/freshysites-support-beacon/',
	__FILE__,
	'freshysites-support-beacon'
);
//Enable Releases
//$myUpdateChecker->getVcsApi()->enableReleaseAssets();
//Optional: If you're using a private repository, specify the access token like this:
//
//
//Future Update Note: Comment in these sections and add token and branch information once private git established
//
//
//$myUpdateChecker->setAuthentication('64f1767c1100462355552d6b96d55a22f9751b5d');
//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('master');
