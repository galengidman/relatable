<?php
/**
 * Plugin Name: Relatable
 * Plugin URI: https://github.com/galengidman/relatable
 * Descriptions: Provides a simple post-to-post relationship framework. Data is stored in dedicated DB table to provide easy two-way access.
 * Version: 0.1.0
 * Author: Galen Gidman
 * Author URI: https://galengidman.com/
 */

define('RELATABLE_VERSION', '1.0.0');
define('RELATABLE_FILE', __FILE__);
define('RELATABLE_PATH', plugin_dir_path(RELATABLE_FILE));
define('RELATABLE_URL', plugin_dir_url(RELATABLE_FILE));

$relatable_channels = [];

include RELATABLE_PATH . 'inc/classes/class-relatable-channel.php';

include RELATABLE_PATH . 'inc/admin.php';
include RELATABLE_PATH . 'inc/database.php';
include RELATABLE_PATH . 'inc/helpers.php';
