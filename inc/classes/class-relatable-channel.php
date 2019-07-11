<?php

class Relatable_Channel {

    public $channel;
    public $name;
    public $from;
    public $to;

    public function __construct($channel, $name, $from, $to) {
        foreach ([$from, $to] as $post_type) {
            if (! post_type_exists($post_type)) {
                add_action('admin_notices', function() use ($post_type, $channel) { ?>
                    <div class="notice notice-error"><p><code><?php echo $post_type; ?></code> is not a valid post type. Channel <code><?php echo $channel; ?></code> is inactive.</p></div>
                <?php });
            }
        }

        $this->channel = $channel;
        $this->name = $name;
        $this->from = $from;
        $this->to = $to;

        global $relatable_channels;
        $relatable_channels[$this->channel] = $this;
    }

    public function to_query($args = []) {
        $args = wp_parse_args($args, [
            'posts_per_page' => -1,
        ]);

        $args['post_type'] = $this->to;

        return new WP_Query($args);
    }

}
