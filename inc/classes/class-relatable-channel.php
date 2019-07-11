<?php

class Relatable_Channel {

    public $channel;
    public $name;
    public $foo_type;
    public $bar_type;

    public function __construct($channel, $name, $foo_type, $foo_args, $bar_type, $bar_args) {
        global $relatable_channels;

        foreach ([$foo_type, $bar_type] as $post_type) {
            if (! post_type_exists($post_type)) {
                new Relatable_Notice("<p><code>{$post_type}</code> is not a valid post type</p>", 'error');
                return;
            }
        }

        $this->channel = $channel;
        $this->name = $name;
        $this->foo_type = $foo_type;
        $this->foo_args = $foo_args;
        $this->bar_type = $bar_type;
        $this->bar_args = $bar_args;

        $relatable_channels[] = $this;

        new Relatable_Condition('foo', $this);
        new Relatable_Condition('bar', $this);
    }

}
