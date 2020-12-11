<?php

// HTTP request to get the data
if (!empty($_GET['fs_count_email'])) {
	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM $wpdb->options WHERE `option_name` LIKE '%fs_count_emails%'");
	$data = array();
	foreach ($result as $month) {
		array_push($data,array($month->option_name=>$month->option_value));
	}
	header('Content-Type: application/json');
	echo json_encode($data);
	exit;
}

// Count the emails that get sent
add_action( 'phpmailer_init', 'fs_count_emails', 10);

function fs_count_emails() {
	$option_name = 'fs_count_emails_' . date('m') . date('y');
	$count = get_option($option_name);
	if ( empty($count) ) { $count = 0; }
	$count++;
	update_option($option_name,$count);
}