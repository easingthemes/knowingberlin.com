<?php

/**
 * Widget
 */
class si_widget extends WP_Widget
{

    /**
     * si_widget constructor.
     */
    public function __construct()
    {
        parent::__construct('si-widget', __('Simple Instagram Widget', 'simple-instagram'));
    }

    /**
     * Widget body
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {

        // Widget title
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];

        echo '<div id="si-widget">';

        // Title
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Limit
        if ($instance['limit']) {
            $limit = ' limit="'. $instance['limit'] .'"';
        } else {
            $limit = null;
        }

        // Caption
        if ($instance['caption'] == 1) {
            $caption = ' caption="true"';
        } else {
            $caption = null;
        }

        // Shortcode
        echo do_shortcode("[simple-instagram $limit $caption]");

        echo '</div>';

        echo $args['after_widget'];

    }

    /**
     * Widget form
     *
     * @param array $instance
     */
    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:', 'simple-instagram'); ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   type="text"
                   value="<?php echo esc_attr($instance['title']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">
                <?php _e('Limit:', 'simple-instagram'); ?>
            </label>
            <input class="small-text"
                   id="<?php echo $this->get_field_id('limit'); ?>"
                   name="<?php echo $this->get_field_name('limit'); ?>"
                   type="text"
                   value="<?php echo esc_attr($instance['limit']); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('caption'); ?>">
                <?php _e('Enable Caption', 'simple-instagram'); ?>
            </label>
            <input id="<?php echo $this->get_field_id('caption'); ?>"
                   name="<?php echo $this->get_field_name('caption'); ?>"
                   type="checkbox"
                <?php checked(1, $instance['caption']); ?>>
        </p>

        <?php
    }

    /**
     * Update widget
     *
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {

        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['limit'] = (!empty($new_instance['limit'])) ? strip_tags($new_instance['limit']) : '';
        $instance['caption'] = (isset($new_instance['caption'])) ? 1 : 0;
        return $instance;

    }

}