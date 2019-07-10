<?php

class Relatable_Relationship {

    protected $channel;
    protected $label;
    protected $foo_type;
    protected $bar_type;

    public function __construct($channel, $label, $foo_type, $bar_type) {
        global $relatable_relationships;

        foreach ([$foo_type, $bar_type] as $post_type) {
            if (! post_type_exists($post_type)) {
                new Relatable_Notice("<p><code>{$post_type}</code> is not a valid post type</p>", 'error');
                return;
            }
        }

        $this->channel = $channel;
        $this->label = $label;
        $this->foo_type = $foo_type;
        $this->bar_type = $bar_type;

        $relatable_relationships[] = $this;

        new Relatable_Condition(
            $this->channel,
            $this->foo_type
        );

        new Relatable_Condition(
            $this->channel,
            $this->bar_type
        );
    }

}
