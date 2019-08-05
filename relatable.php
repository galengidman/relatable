<?php
/**
 * Plugin Name: Relatable
 * Plugin URI: https://github.com/galengidman/relatable
 * Description: Provides a simple post-to-post relationship framework. Data is stored in dedicated DB table to enable easy two-way access.
 * Version: 0.2.0
 * Author: Galen Gidman
 * Author URI: https://galengidman.com/
 */

define('RELATABLE_VERSION', '0.2.0');
define('RELATABLE_FILE', __FILE__);
define('RELATABLE_PATH', plugin_dir_path(RELATABLE_FILE));
define('RELATABLE_URL', plugin_dir_url(RELATABLE_FILE));

$relatable_channels = [];

add_action('plugins_loaded', function() {
	include_once RELATABLE_PATH . 'vendor/autoload.php';

	Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/galengidman/relatable/',
		RELATABLE_FILE,
		'relatable'
	);

	include RELATABLE_PATH . 'inc/classes/class-relatable-channel.php';

	include RELATABLE_PATH . 'inc/admin.php';
	include RELATABLE_PATH . 'inc/database.php';
	include RELATABLE_PATH . 'inc/helpers.php';
});
