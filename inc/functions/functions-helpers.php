<?php

function relatable_get_post_type_label($post_type) {
    $object = get_post_type_object($post_type);
    return $object->labels->name;
}
