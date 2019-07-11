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
