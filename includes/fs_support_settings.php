<?php
//Simple Security
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// Get Options, and do things

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
