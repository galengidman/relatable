<?php

function relatable_get_post_channels($post_id = null) {
	$post_id = $post_id ?? get_the_ID();

	global $relatable_channels;

	return array_filter($relatable_channels, function($c) use ($post_id) {
		return get_post_type($post_id) === $c->from;
	});
}

function relatable_should_activate_admin() {
	return is_admin()
		&& in_array(get_current_screen()->base, ['post', 'post-new'])
		&& relatable_get_post_channels();
}

function relatable_get_to($channel, $post_id = null) {
	$post_id = $post_id ?? get_the_ID();

	global $wpdb;

	$rows = $wpdb->get_results("
		SELECT to_id
		FROM {$wpdb->prefix}relatable
		WHERE from_id = {$post_id}
		AND channel = '{$channel}'
	");

	return array_map(function($r) {
		return absint($r->to_id);
	}, $rows);
}

function relatable_get_from($channel, $post_id = null) {
	$post_id = $post_id ?? get_the_ID();

	global $wpdb;

	$rows = $wpdb->get_results("
		SELECT from_id
		FROM {$wpdb->prefix}relatable
		WHERE to_id = {$post_id}
		AND channel = '{$channel}'
	");

	return array_map(function($r) {
		return absint($r->from_id);
	}, $rows);
}
