<?php

function relatable_get_channels_for_post($post_id = null) {
    global $relatable_conditions;

    $post_id = $post_id ?? get_the_ID();

    $active_conditions = array_filter($relatable_conditions, function($c) use ($post_id) {
        return $c->active($post_id);
    });

    $grouped_conditions = [];

    foreach ($active_conditions as $condition) {
        $grouped_conditions[$condition->channel->channel] = $condition;
    }

    return $grouped_conditions;
}
