<?php

/**
 * activello Top Posts Slider Widget
 * activello Theme
 */
class notamagic_recent_posts_slider extends WP_Widget
{
     function __construct(){

        $widget_ops = array('classname' => 'activello-recent-posts','description' => esc_html__( "Notamagic recent posts slider", 'activello') );
            parent::__construct('notamagic_recent_posts_slider', esc_html__('Notamagic Recent Posts Slider','activello'), $widget_ops);
    }

    function widget($args , $instance) {
        extract($args);
        $title = isset($instance['title']) ? esc_html( $instance['title'] ) : esc_html__('recent Posts', 'activello');
        $limit = isset($instance['limit']) ? esc_html( $instance['limit'] ) : 5;

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;

        /**
         * Widget Content
         */
    ?>

    <!-- recent posts -->
        <div class="flexslider">
            <ul class="slides">
                <?php

                  $featured_args = array(
                      'posts_per_page' => $limit,
                      'ignore_sticky_posts' => 1
                    );

                  $featured_query = new WP_Query($featured_args);

                  /**
                   * Check if zilla likes plugin exists
                   */
                  if($featured_query->have_posts()) : while($featured_query->have_posts()) : $featured_query->the_post();

                    ?>
                        <?php
                            $featuredimage_values = get_post_custom_values('show_featured_image', get_the_ID());
                        ?>
                        <?php if(get_the_content() != '' && $featuredimage_values[0]) : ?>

                        <!-- post -->
                        <li>
                            <?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
                            <div class="flex-caption">
                                <?php echo get_the_category_list(); ?>

                                <?php if(get_the_title() != '') : ?>
                                    <a href="<?php echo get_permalink() ?>">
                                        <h2 class="entry-title">
                                        <?php echo get_the_title() ?>
                                        </h2>
                                    </a>
                                <?php endif; ?>
                                <div class="read-more">
                                    <a href="<?php echo get_permalink() ?>">
                                    <?php echo  __( 'Read More', 'activello' ) ?>
                                    </a>
                                </div>
                            </div>
                        </li><!-- end post -->
                        <?php endif; ?>

                    <?php

                  endwhile; endif; wp_reset_query();

                ?>
            </ul>
        </div> <!-- end posts wrapper -->

        <?php
        echo $after_widget;
    }

    function form($instance) {

      if(!isset($instance['title'])) $instance['title'] = esc_html__('recent Posts', 'activello');
      if(!isset($instance['limit'])) $instance['limit'] = 5;

        ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'activello') ?></label>

      <input  type="text" value="<?php echo esc_html($instance['title']); ?>"
              name="<?php echo $this->get_field_name('title'); ?>"
              id="<?php $this->get_field_id('title'); ?>"
              class="widefat" />
      </p>

      <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Limit Posts Number', 'activello') ?></label>

      <input  type="number" value="<?php echo esc_html($instance['limit']); ?>"
              name="<?php echo $this->get_field_name('limit'); ?>"
              id="<?php $this->get_field_id('limit'); ?>"
              class="widefat" />
      <p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) && is_numeric( $new_instance['limit'] )  ) ? esc_html( $new_instance['limit'] ) : '';

        return $instance;
    }
}
?>
