<?php

add_action('add_meta_boxes', function() {
    if (in_array(get_current_screen()->base, ['post', 'post-new']) && relatable_get_channels_for_post()) {
        add_meta_box(
            'relatable',
            'Relationships',
            'relatable_metabox'
        );
    }
});

function relatable_metabox() {
    foreach (relatable_get_channels_for_post() as $channel => $condition) {
        ?>
        <h2><?php echo $condition->channel->name; ?></h2>
        <?php $query = $condition->query(); ?>
        <select multiple>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <option value="<?php the_ID(); ?>"><?php the_title(); the_time(); ?></option>
            <?php endwhile; wp_reset_postdata(); ?>
        </select>
        <?php
    }
}
