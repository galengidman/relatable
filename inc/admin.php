<?php

add_action('add_meta_boxes', function() {
    if (! relatable_should_activate_admin()) {
        return;
    }

    add_meta_box(
        'relatable',
        'Relationships',
        'relatable_metabox'
    );
});

function relatable_metabox() {
    foreach (relatable_get_post_channels() as $channel) : ?>
        <?php $selected = relatable_get_to($channel->channel); ?>
        <div class="relatable-channel" data-relatable-channel="<?php echo $channel->channel; ?>">
            <h4 class="relatable-title"><?php echo $channel->name; ?></h4>

            <div class="relatable-cols">
                <div class="relatable-col">
                    <ul class="relatable-list" data-relatable-list="unselected">
                        <?php $unselected = $channel->to_query(['post__not_in' => $selected]); ?>
                        <?php while ($unselected->have_posts()) : $unselected->the_post(); ?>
                            <li>
                                <input type="hidden" name="relatable[<?php echo $channel->channel; ?>][unselected][]" value="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                                <small>(ID: <?php the_ID(); ?>)</small>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>

                <div class="relatable-col">
                    <ul class="relatable-list" data-relatable-list="selected">
                        <?php $selected = $channel->to_query(['post__in' => $selected, 'orderby' => 'post__in']); ?>
                        <?php while ($selected->have_posts()) : $selected->the_post(); ?>
                            <li>
                                <input type="hidden" name="relatable[<?php echo $channel->channel; ?>][selected][]" value="<?php the_ID(); ?>">
                                <?php the_title(); ?>
                                <small>(ID: <?php the_ID(); ?>)</small>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach;
}

add_action('save_post', function($post_id) {
    global $wpdb;

    $table = $wpdb->prefix . 'relatable';

    foreach ($_POST['relatable'] as $channel => $data) {
        $wpdb->delete($table, [
            'from_id' => $post_id,
            'channel' => $channel,
        ]);

        $insert_values = $data['selected'];
        $insert_values = array_map(function($to) use ($post_id, $channel) {
            return "({$post_id}, {$to}, '{$channel}')";
        }, $insert_values);
        $insert_values = join(',', $insert_values);

        return $wpdb->query("
            INSERT INTO {$table}
                (from_id, to_id, channel)
            VALUES
                {$insert_values};
        ");
    }
});

add_action('admin_enqueue_scripts', function() {
    if (! relatable_should_activate_admin()) {
        return;
    }

    wp_enqueue_style(
        'relatable-admin',
        RELATABLE_URL . 'assets/css/admin.css'
    );

    wp_enqueue_script(
        'relatable-admin',
        RELATABLE_URL . 'assets/js/admin.js',
        ['jquery', 'jquery-ui-sortable']
    );
});
