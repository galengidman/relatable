<?php
/**
 * Plugin Name: Relatable
 */

define('RELATABLE_VERSION', '1.0.0');
define('RELATABLE_FILE', __FILE__);
define('RELATABLE_PATH', plugin_dir_path(RELATABLE_FILE));
define('RELATABLE_URL', plugin_dir_url(RELATABLE_FILE));

$relatable_conditions = [];
$relatable_notices = [];
$relatable_relationships = [];

include RELATABLE_PATH . 'inc/classes/class-relatable-condition.php';
include RELATABLE_PATH . 'inc/classes/class-relatable-notice.php';
include RELATABLE_PATH . 'inc/classes/class-relatable-relationship.php';

include RELATABLE_PATH . 'inc/functions/functions-helpers.php';
include RELATABLE_PATH . 'inc/functions/functions-relationships.php';

include RELATABLE_PATH . 'inc/admin.php';
include RELATABLE_PATH . 'inc/database.php';
include RELATABLE_PATH . 'inc/notices.php';

add_action('init', function() {
    new Relatable_Relationship(
        'posts_pages',
        'Events ↔ Pages',
        'event',
        'page'
    );
});
