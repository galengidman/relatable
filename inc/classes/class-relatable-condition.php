<?php

class Relatable_Condition {

    public $foobar;
    public $channel;
    public $this_type;
    public $this_args;
    public $other_type;
    public $other_args;

    public function __construct($foobar, $channel) {
        global $relatable_conditions;

        $this->foobar = $foobar;
        $this->channel = $channel;

        $this->this_type = $this->foobar === 'foo'
            ? $channel->foo_type
            : $channel->bar_type;

        $this->this_args = new Relatable_Condition_Args($this->foobar === 'foo'
            ? $channel->foo_args
            : $channel->bar_args);

        $this->other_type = $this->foobar === 'foo'
            ? $channel->bar_type
            : $channel->foo_type;

        $this->other_args = new Relatable_Condition_Args($this->foobar === 'foo'
            ? $channel->bar_args
            : $channel->foo_args);

        $relatable_conditions[] = $this;
    }

    public function active($post_id) {
        $active = get_post_type($post_id) === $this->this_type;

        return apply_filters(
            "relatable_{$this->channel->channel}_{$this->this_type}_active",
            $active,
            $post_id
        );
    }

    public function query() {
        $query_args = wp_parse_args($this->other_args->query_args, [
            'posts_per_page' => 2,
        ]);

        $query_args['post_type'] = $this->other_type;

        return new WP_Query($query_args);
    }

}
