<?php
/**
 * Plugin Name: Relatable
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

add_action('init', function() {
    new Relatable_Channel(
        'posts_pages',
        'Posts → Pages',
        'post',
        'page',
    );

    new Relatable_Channel(
        'pages_events',
        'Pages → Events',
        'page',
        'event',
    );
});
