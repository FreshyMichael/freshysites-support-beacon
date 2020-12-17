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
$fs_version = '3.1.0';

//Define PLUGIN_DIR if not already defined
if ( ! (defined( 'PLUGIN_DIR' )){
define('PLUGIN_DIR' , dirname(__FILE__).'/');
}

//Include these files always
include 'includes/fs_count_emails_wp.php';
include 'includes/fs_support_settings.php';

//Include these file is User is logged in AND is administrator
function fs_adminOnly_functions(){
	
	//Get the current user
	$user = wp_get_current_user();

	//Array of user roles allowed to see plugin's admin functionality
	$allowed_roles = array('administrator');
		if ( array_intersect( $allowed_roles, $user->roles )&&(is_user_logged_in())) {

			//Include the Administrator Only function files
			include 'includes/fs-dashboard-widget.php';
			include 'includes/fs-support-beacon.php';
			include 'includes/fs-menu-pages.php';
		}
		else {
			//Do nothing
		}
}

//Add the action

add_action ('after_setup_theme' , 'fs_adminOnly_functions');
//Begin enqueue FreshySites Custom Admin dashboard
function freshysites_admin_theme() {
    $dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('freshysites-admin-theme', $dir . '/fs-admin.css', array(), $fs_version, 'all');
}
add_action( 'admin_enqueue_scripts', 'freshysites_admin_theme' );

// All About Updates

//  Begin Version Control | Auto Update Checker
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/FreshyMichael/freshysites-support-beacon',
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
