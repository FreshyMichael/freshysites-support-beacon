<?php
//Simple Security
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Get Options, and do things

//Hide Jetpack Notice based on Option Selection
$fs_hide_jetpack_warning = get_option('hide_jetpack_threat_select');

function hide_jetpack_warnings(){
	if ('option1' == $fs_hide_jetpack_warning[0]){ // If Yes is Selected
		echo '<style> li#wp-admin-bar-jetpack-scan-notice{display:none!important;} </style>';
	}
	else{ 
		return; //Return Nothing 
	}
}

//Add action with admin_head
add_action('admin_head', 'hide_jetpack_warnings');