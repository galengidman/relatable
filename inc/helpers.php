<?php

function relatable_get_post_channels($post_id = null) {
    $post_id = $post_id ?? get_the_ID();

    global $relatable_channels;

    return array_filter($relatable_channels, function($c) use ($post_id) {
        return get_post_type($post_id) === $c->from;
    });
}

function relatable_get_post_type_label($post_type) {
    $object = get_post_type_object($post_type);
    return $object->labels->name;
}

function relatable_admin_active() {
    return is_admin()
        && in_array(get_current_screen()->base, ['post', 'post-new'])
        && relatable_get_post_channels();
}
