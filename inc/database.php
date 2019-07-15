<?php

add_action('init', function() {
	global $wpdb;

	$option_name = 'relatable_db_ver';

	if (get_option($option_name) === RELATABLE_VERSION) {
		return;
	}

	if (! function_exists('dbDelta')) {
		include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	}

	dbDelta("CREATE TABLE {$wpdb->prefix}relatable (
		id bigint(20) unsigned NOT NULL auto_increment,
		from_id bigint(20) unsigned NOT NULL DEFAULT 0,
		to_id bigint(20) unsigned NOT NULL DEFAULT 0,
		channel varchar(100) NOT NULL,
		PRIMARY KEY  (id)
	) {$wpdb->get_charset_collate()};");

	update_option($option_name, RELATABLE_VERSION);
});

add_action('delete_post', function($post_id) {
	global $wpdb;

	$table = $wpdb->prefix . 'relatable';

	$wpdb->delete($table, ['from_id' => $post_id]);
	$wpdb->delete($table, ['to_id' => $post_id]);
});
