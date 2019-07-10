<?php

add_action('admin_notices', function() {
    global $relatable_notices;

    foreach ($relatable_notices as $notice) {
        echo $notice->html();
    }
});
