<?php

class Relatable_Condition {

    protected $channel;
    protected $post_type;

    public function __construct($channel, $post_type) {
        global $relatable_conditions;

        $this->channel = $channel;
        $this->post_type = $post_type;

        $relatable_conditions[] = $this;
    }

    public function active($post_id) {
        $active = get_post_type($post_id) === $this->post_type;
        return apply_filters("relatable_{$this->channel}_{$this->post_type}_active", $active, $post_id);
    }

}
