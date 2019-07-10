<?php

add_action('add_meta_boxes', function() {
    global $relatable_conditions;

    if (! in_array(get_current_screen()->base, ['post', 'post-new'])) {
        return;
    }

    foreach ($relatable_conditions as $condition) {
        if ($condition->active(get_the_ID())) {
            add_meta_box('relatable', 'Relationships', 'relatable_metabox');
            return;
        }
    }
});

function relatable_metabox() {
    global $relatable_conditions;

    foreach ($relatable_conditions as $condition) {

    }

    echo 'hi';
}
